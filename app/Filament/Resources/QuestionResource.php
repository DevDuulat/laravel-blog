<?php

namespace App\Filament\Resources;

use App\Filament\Resources\QuestionResource\Pages;
use App\Models\Question;
use Filament\Forms;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Get;

class QuestionResource extends Resource
{
    protected static ?string $model = Question::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([

            Select::make('test_id')
                ->relationship('test', 'id')
                ->getOptionLabelFromRecordUsing(fn ($record) =>
                    $record->getTranslation('title', 'ru') . ' / ' . $record->getTranslation('title', 'kg')
                )
                ->required()
                ->label('Тест'),

            Repeater::make('questions_data')
                ->label('Вопросы')
                ->rules(['min:1'])
                ->validationMessages([
                    'min' => 'Нужно добавить хотя бы один вопрос',
                ])
                ->schema([

                    Tabs::make('LangTabs')
                        ->tabs([
                            Tabs\Tab::make('Русский')
                                ->schema([
                                    Textarea::make('question.ru')->label('Вопрос (RU)')->required(),
                                    Textarea::make('explanation.ru')->label('Пояснение (RU)'),
                                    Repeater::make('answers')
                                        ->label('Ответы (RU)')
                                        ->validationMessages([
                                            'minItems' => 'Добавьте 5 ответа',
                                            'maxItems' => 'Должно быть ровно 5 ответа',
                                        ])
                                        ->schema([
                                            Textarea::make('answer.ru')->label('Ответ')->required(),
                                            Forms\Components\Toggle::make('is_correct')->label('Правильный?'),
                                        ])
                                        ->minItems(1)
                                        ->maxItems(5)
                                        ->columns(1),
                                ]),

                            Tabs\Tab::make('Кыргызча')
                                ->schema([
                                    Textarea::make('question.kg')->label('Суроо (KG)')->required(),
                                    Textarea::make('explanation.kg')->label('Түшүндүрмө (KG)'),
                                    Repeater::make('answers')
                                        ->label('Жооптор (KG)')
                                        ->schema([
                                            Textarea::make('answer.kg')->label('Жооп')->required(),
                                            Forms\Components\Toggle::make('is_correct')->label('Туурабы?'),
                                        ])
                                        ->minItems(1)
                                        ->maxItems(5)
                                        ->columns(1),
                                ]),
                        ])
                        ->columnSpanFull(),

                    FileUpload::make('image')
                        ->label('Изображение')
                        ->image(),

                    TextInput::make('video')
                        ->label('Видео'),
                ])
                ->defaultItems(1)
                ->columnSpanFull()
                ->itemLabel(fn ($state) =>
                str($state['question']['ru'] ?? 'Вопрос')->limit(30)
                ),
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
