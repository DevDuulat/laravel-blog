<?php

namespace App\Filament\Resources\QuestionResource\Pages;

use App\Filament\Resources\QuestionResource;
use App\Models\Question;
use Filament\Resources\Pages\CreateRecord;

class CreateQuestion extends CreateRecord
{
    protected static string $resource = QuestionResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['question'] = 'temporary';
        return $data;
    }

    protected function afterCreate(): void
    {
        $data = $this->form->getState();

        $testId = $data['test_id'];
        $questionsData = $data['questions_data'];

        foreach ($questionsData as $questionData) {
            $question = Question::create([
                'test_id' => $testId,
                'question' => $questionData['question'],
                'explanation' => $questionData['explanation'] ?? null,
                'image' => $questionData['image'] ?? null,
                'video' => $questionData['video'] ?? null,
            ]);

            foreach ($questionData['answers'] as $index => $answer) {
                $question->answers()->create([
                    'answer' => $answer['answer'],
                    'is_correct' => $answer['is_correct'] ?? false,
                    'group_index' => $index,
                ]);
            }
        }

        $this->record->delete(); // удаляем временную заглушку
    }

    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('index'); // редирект на список
    }
}
