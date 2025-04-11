<?php

namespace App\Filament\Resources;

use App\Filament\Resources\QuestionResource\Pages;
use App\Models\Question;
use Filament\Forms;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class QuestionResource extends Resource
{
    protected static ?string $model = Question::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('test_id')
                    ->relationship('test', 'title')
                    ->required()
                    ->label('Тест'),

                // 🔥 Repeater для ВОПРОСОВ
                Repeater::make('questions_data')
                    ->label('Вопросы')
                    ->schema([
                        Textarea::make('question')
                            ->label('Вопрос')
                            ->required()
                            ->columnSpanFull(),

                        Textarea::make('explanation')
                            ->label('Пояснение')
                            ->rows(3),

                        FileUpload::make('image')
                            ->label('Изображение')
                            ->image(),

                        TextInput::make('video')
                            ->label('Видео'),

                        // 🔥 Repeater для ОТВЕТОВ
                        Repeater::make('answers')
                            ->label('Ответы')
                            ->schema([
                                Textarea::make('answer')
                                    ->label('Ответ')
                                    ->required(),
                                Toggle::make('is_correct')
                                    ->label('Правильный?')
                                    ->default(false),
                            ])
                            ->minItems(4)
                            ->maxItems(4)
                            ->columns(1),
                    ])
                    ->columnSpanFull()
                    ->defaultItems(1) // чтобы сразу был 1 вопрос при открытии формы
                    ->itemLabel(fn ($state) => str($state['question'])->limit(20)),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('test.title')
                    ->label('Тест')
                    ->searchable(),
                Tables\Columns\TextColumn::make('question')
                    ->label('Вопрос')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Создано')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListQuestions::route('/'),
            'create' => Pages\CreateQuestion::route('/create'),
            'edit' => Pages\EditQuestion::route('/{record}/edit'),
        ];
    }
}
