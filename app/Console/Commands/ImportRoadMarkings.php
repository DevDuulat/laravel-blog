<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Goutte\Client;
use App\Models\Category;
use App\Models\Content;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class ImportRoadMarkings extends Command
{
    protected $signature = 'import:roadmarkings {--fresh : Очистить старые данные перед импортом}';
    protected $description = 'Импорт дорожной разметки с joldo.kg';

    protected array $categoryMap = [];

    protected array $predefinedSlugs = [
        'Горизонтальная разметка' => [
            'ru' => 'gorizontalnaia-razmetka',
            'kg' => 'gorizontaldyk-belgiler',
        ],
        'Вертикальная разметка' => [
            'ru' => 'vertikalnaia-razmetka',
            'kg' => 'vertikalduu-belgiler',
        ],
        'Дополнительно' => [
            'ru' => 'dopolnitelno',
            'kg' => 'kosumcha',
        ],
    ];

    public function handle()
    {
        $client = new Client();
        $url = 'https://joldo.kg/ru/razmetka';
        $crawler = $client->request('GET', $url);

        if ($this->option('fresh')) {
            $this->cleanOldData();
        }

        $this->info('Импорт категорий...');
        $this->importCategories($crawler);

        $this->info('Импорт контента...');
        $this->importMarkings($crawler);

        $this->info('✅ Импорт завершён!');
    }

    protected function cleanOldData()
    {
        $this->warn('Очистка старых категорий и контента...');
        $parentCategory = Category::where('slug->ru', 'dorozhnaya-razmetka')->first();

        if ($parentCategory) {
            $subcategories = Category::where('parent_id', $parentCategory->id)->pluck('id');
            Content::whereIn('category_id', $subcategories)->delete();
            Category::whereIn('id', $subcategories)->delete();
            $this->info('Старые данные удалены.');
        } else {
            $this->warn('Родительская категория не найдена.');
        }
    }

    protected function importCategories($crawler)
    {
        $parentCategory = Category::firstOrCreate(
            ['slug->ru' => 'dorozhnaya-razmetka'],
            [
                'name' => ['ru' => 'Дорожная разметка', 'kg' => 'Зол сызыктары'],
                'slug' => ['ru' => 'dorozhnaya-razmetka', 'kg' => 'zol-syzyktary'],
                'category_type' => 'page',
                'is_active' => true,
                'parent_id' => null,
            ]
        );

        $crawler->filter('.category-item, .masonry-filters .nav-link')->each(function ($node) use ($parentCategory) {
            $groupId = $node->attr('data-group');
            $nameRu = trim($node->text());
            if ($nameRu === 'Все') return;

            $slugRu = $this->predefinedSlugs[$nameRu]['ru'] ?? Str::slug($nameRu);
            $slugKg = $this->predefinedSlugs[$nameRu]['kg'] ?? Str::slug($nameRu);

            $category = Category::firstOrCreate(
                ['slug->ru' => $slugRu],
                [
                    'name' => ['ru' => $nameRu, 'kg' => $nameRu],
                    'slug' => ['ru' => $slugRu, 'kg' => $slugKg],
                    'category_type' => 'page',
                    'is_active' => true,
                    'parent_id' => $parentCategory->id,
                ]
            );

            $this->categoryMap[$groupId] = $category->id;
            $this->info("Категория: {$nameRu}");
        });
    }

    protected function importMarkings($crawler)
    {
        $crawler->filter('.shuffle-item')->each(function ($node) {
            $linkNode = $node->filter('h6 a');
            $titleText = trim($linkNode->text());
            $slug = Str::slug($titleText);
            $relativeUrl = $linkNode->attr('href');
            $url = 'https://joldo.kg' . $relativeUrl;

            $groups = json_decode(html_entity_decode($node->attr('data-groups')));
            $categoryId = $groups && isset($this->categoryMap[$groups[0]]) ? $this->categoryMap[$groups[0]] : null;
            if (!$categoryId) {
                $this->warn("⚠️ Категория не найдена для: {$titleText}");
                return;
            }

            $imgNode = $node->filter('.sign-img img');
            $coverPath = $imgNode->count() ? $this->downloadImage('https://joldo.kg' . $imgNode->attr('src')) : null;

            $client = new Client();
            $page = $client->request('GET', $url);

            // Извлекаем только текст
            $contentText = '';
            $page->filter('section.container')->each(function ($section) use (&$contentText) {
                foreach ($section->filter('p, li, h1, h2, h3, h4, h5, h6, strong, b') as $el) {
                    $text = trim($el->textContent);
                    if ($text) {
                        $contentText .= $text . "\n";
                    }
                }
            });

            // Очистка текста
            $contentText = $this->cleanText($contentText, $titleText);

            Content::updateOrCreate(
                ['slug->ru' => $slug],
                [
                    'category_id' => $categoryId,
                    'type' => 'page',
                    'title' => ['ru' => $titleText, 'kg' => $titleText],
                    'slug' => ['ru' => $slug, 'kg' => $slug],
                    'content' => ['ru' => $contentText, 'kg' => $contentText],
                    'cover' => $coverPath,
                    'status' => 'published',
                    'published_at' => now(),
                    'meta_title' => ['ru' => $titleText, 'kg' => $titleText],
                    'meta_description' => ['ru' => Str::limit($contentText, 150), 'kg' => Str::limit($contentText, 150)],
                    'meta_keywords' => ['ru' => implode(', ', $this->extractKeywords($titleText)), 'kg' => implode(', ', $this->extractKeywords($titleText))],
                ]
            );

            $this->info("✅ Разметка импортирована: {$titleText}");
        });
    }

    protected function cleanText($text, $title)
    {
        // Убираем мусор и повторения
        $patterns = [
            '/Главная/iu',
            '/Дорожная\s*разметка[^0-9\n]*/iu',
            '/Разметка\s*\d+(\.\d+)*/iu',
            '/\s{2,}/',
        ];
        $text = preg_replace($patterns, ' ', $text);

        // Убираем повторяющиеся заголовки
        $text = str_replace($title, '', $text);

        // Удаляем слово "Примечание" в конце
        $text = preg_replace('/Примечание.*$/ius', '', $text);

        // Обрезаем и чистим
        $text = trim(preg_replace("/\n{2,}/", "\n", $text));

        return $text;
    }

    protected function extractKeywords($text)
    {
        $text = mb_strtolower($text);
        $words = preg_split('/[\s,]+/u', $text);
        return array_filter(array_unique($words), fn($w) => mb_strlen($w) > 3);
    }

    protected function downloadImage($url)
    {
        $response = Http::get($url);
        if (!$response->successful()) {
            $this->warn("Не удалось скачать изображение: {$url}");
            return null;
        }

        $name = basename(parse_url($url, PHP_URL_PATH));
        $path = "roadmarkings/{$name}";
        Storage::put("public/{$path}", $response->body());

        return $path;
    }
}
