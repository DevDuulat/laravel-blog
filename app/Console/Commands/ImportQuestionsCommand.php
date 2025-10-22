<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Test;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImportQuestionsCommand extends Command
{
    protected $signature = 'import:questions {--file=questions.json}';
    protected $description = 'Импорт вопросов и ответов из JSON в базу данных по билетам';

    public function handle(): int
    {
        $filePath = $this->option('file');
        $fullPath = base_path($filePath);

        if (!file_exists($fullPath)) {
            $this->error("Файл не найден: {$fullPath}");
            return Command::FAILURE;
        }

        $json = file_get_contents($fullPath);
        $data = json_decode($json, true);

        if (!isset($data['questionnaires'])) {
            $this->error('Неверная структура JSON.');
            return Command::FAILURE;
        }

        // Ищем или создаем категорию "по билетам"
        $category = Category::firstOrCreate(
            ['slug->ru' => 'po-biletam'],
            [
                'name' => [
                    'ru' => 'по билетам',
                    'kg' => 'biletter-boiunca',
                ],
                'slug' => [
                    'ru' => 'po-biletam',
                    'kg' => 'biletter-boiunca',
                ],
                'category_type' => 'test',
                'is_active' => true,
            ]
        );

        $this->info("Используем категорию: " . $category->getTranslation('name', 'ru') . " (ID: {$category->id})");

        // Группируем вопросы по билетам
        $tickets = [];
        foreach ($data['questionnaires'] as $item) {
            $tickets[$item['question_category']][] = $item;
        }

        foreach ($tickets as $categoryNumber => $questions) {
            // Создаем тест для каждого билета
            $test = new Test();
            $test->id = Str::uuid();
            $test->category_id = $category->id;
            $test->title = [
                'ru' => "Билет {$categoryNumber}",
                'kg' => "Билет {$categoryNumber}",
            ];
            $test->duration = 20; // Можно указать нужную длительность
            $test->save();

            $this->info("Создан тест для билета {$categoryNumber} (ID: {$test->id})");

            // Импортируем вопросы
            foreach ($questions as $item) {
                $question = new Question();
                $question->id = Str::uuid();
                $question->test_id = $test->id;
                $question->question = [
                    'ru' => $item['question'],
                    'kg' => $item['question'],
                ];
                $question->explanation = [
                    'ru' => $item['correct_ans_alls'],
                    'kg' => $item['correct_ans_alls'],
                ];

                // Загружаем изображение, если есть
                if (!empty($item['image_q'])) {
                    $filename = $item['image_q'];
                    $found = false;

                    $dir = storage_path('app/public/questions');
                    if (is_dir($dir)) {
                        foreach (scandir($dir) as $file) {
                            if ($file === '.' || $file === '..') continue;
                            $basename = pathinfo($file, PATHINFO_FILENAME);
                            if (strcasecmp($basename, $filename) === 0) {
                                $question->image = 'questions/' . $file; // относительный путь для базы
                                $found = true;
                                break;
                            }
                        }
                    }

                    if (!$found) {
                        $this->warn("Картинка не найдена для вопроса: {$item['question']} ({$filename})");
                    }
                }



                $question->save();

                // Добавляем ответы
                foreach ($item['answers'] as $index => $answerText) {
                    $answer = new Answer();
                    $answer->id = Str::uuid();
                    $answer->question_id = $question->id;
                    $answer->answer = [
                        'ru' => $answerText,
                        'kg' => $answerText,
                    ];
                    $answer->group_index = $index + 1;
                    $answer->is_correct = ($index + 1) === (int)$item['correct_answer'];
                    $answer->save();
                }

                $this->info("Добавлен вопрос: {$item['question']}");
            }
        }

        $this->info('✅ Импорт всех билетов завершён!');
        return Command::SUCCESS;
    }
}
