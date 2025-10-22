<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Goutte\Client;
use App\Models\Category;
use App\Models\Content;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class ImportRoadSigns extends Command
{
    protected $signature = 'import:roadsigns';
    protected $description = 'Импорт дорожных знаков с joldo.kg';

    protected array $categoryMap = []; // Сопоставление group-id => category_id

    public function handle()
    {
        $client = new Client();
        $url = 'https://joldo.kg/ru/znaki';
        $crawler = $client->request('GET', $url);

        $this->info('Импорт категорий...');
        $this->importCategories($crawler);

        $this->info('Импорт знаков...');
        $this->importSigns($crawler);

        $this->info('Импорт завершен!');
    }

    protected function importCategories($crawler)
    {
        // получаем родительскую категорию
        $parentCategory = Category::where('slug->ru', 'dorozhnye-znaki')->first();

        $crawler->filter('.category-item')->each(function ($node) use ($parentCategory) {
            $groupId = $node->attr('data-group');
            $nameRu = trim($node->text());
            if ($nameRu === 'Все') return;

            $category = Category::firstOrCreate(
                ['slug->ru' => Str::slug($nameRu)],
                [
                    'name' => [
                        'ru' => $nameRu,
                        'kg' => $nameRu, // заглушка
                    ],
                    'slug' => [
                        'ru' => Str::slug($nameRu),
                        'kg' => Str::slug($nameRu),
                    ],
                    'category_type' => 'page',
                    'is_active' => true,
                    'parent_id' => $parentCategory->id, // <-- привязка к родителю
                ]
            );

            $this->categoryMap[$groupId] = $category->id;
            $this->info("Категория создана: {$nameRu}");
        });
    }

   protected function importSigns($crawler)
{
    $crawler->filter('article.shuffle-item')->each(function ($node) {
        $linkNode = $node->filter('h6 a');
        $titleText = trim($linkNode->text());
        $slug = Str::slug($titleText);
        $relativeUrl = $linkNode->attr('href');
        $url = 'https://joldo.kg' . $relativeUrl;

        // Категория
        $groupsAttr = html_entity_decode($node->attr('data-groups'));
        $groups = json_decode($groupsAttr);
        $categoryId = $groups && isset($this->categoryMap[$groups[0]]) ? $this->categoryMap[$groups[0]] : null;
        if (!$categoryId) {
            $this->warn("Не найдена категория для знака: {$titleText}");
            return;
        }

        // Главная картинка (обложка)
        $imgNode = $node->filter('.sign-img img');
        $coverPath = null;
        if ($imgNode->count()) {
            $imgUrl = 'https://joldo.kg' . $imgNode->attr('src');
            $coverPath = $this->downloadImage($imgUrl);
        }

        // Парсим страницу знака
        $client = new Client();
        $signPage = $client->request('GET', $url);
        $contentHtml = '';

        $signPage->filter('section.container')->each(function ($section) use (&$contentHtml) {
            $sectionCrawler = $section;

            // 1. Заголовок знака: берем первый <p> или <h*> с текстом "Знак ..."
            $heading = '';
            foreach ($sectionCrawler->filter('p, h1, h2, h3, h4, h5, h6') as $el) {
                $text = trim($el->textContent);
                if (preg_match('/^Знак\s+\d/i', $text)) {
                    $heading = $text;
                    break;
                }
            }

            if ($heading) {
                $contentHtml .= '<h2 style="text-align:center; margin-bottom:1rem;">' . e($heading) . '</h2>';
            }

            // 2. Текст: все <p>, но без <img>
            foreach ($sectionCrawler->filter('p') as $p) {
                $pNode = new \DOMDocument();
                @$pNode->loadHTML(mb_convert_encoding($p->ownerDocument->saveHTML($p), 'HTML-ENTITIES', 'UTF-8'));
                // Убираем все картинки
                $imgs = $pNode->getElementsByTagName('img');
                while ($imgs->length) {
                    $img = $imgs->item(0);
                    $img->parentNode->removeChild($img);
                }
                $textContent = trim($pNode->textContent);
                if ($textContent) {
                    $contentHtml .= '<p style="margin-bottom:0.75rem;">' . e($textContent) . '</p>';
                }
            }

            // 3. Можно добавить <ul>/<ol> отдельно, если есть списки
            foreach ($sectionCrawler->filter('ul, ol') as $list) {
                $listHtml = $list->ownerDocument->saveHTML($list);
                $contentHtml .= $listHtml;
            }
        });

        // Создаем или обновляем контент
        Content::updateOrCreate(
            ['slug->ru' => $slug],
            [
                'category_id' => $categoryId,
                'type' => 'page',
                'title' => [
                    'ru' => $titleText,
                    'kg' => $titleText, // пока заглушка
                ],
                'slug' => [
                    'ru' => $slug,
                    'kg' => $slug,
                ],
                'content' => [
                    'ru' => $contentHtml,
                    'kg' => $contentHtml,
                ],
                'cover' => $coverPath,
                'status' => 'published',
                'published_at' => now(),
            ]
        );

        $this->info("Знак импортирован: {$titleText}");
    });
}


   protected function downloadImage($url)
{
    $response = Http::get($url);
    if (!$response->successful()) {
        $this->warn("Не удалось скачать изображение: {$url}");
        return null;
    }

    $name = basename(parse_url($url, PHP_URL_PATH));
    $path = "roadsigns/{$name}"; // путь относительно storage/app/public

    Storage::put("public/{$path}", $response->body());

    // возвращаем путь **без /storage**, чтобы в Blade использовать asset('storage/' . $cover)
    return $path; 
}

}
