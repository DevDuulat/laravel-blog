<?php

namespace App\Filament\Resources;

use App\Filament\Resources\QuestionResource\Pages;
use App\Models\Question;
use Filament\Forms;
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

            Select::make('active_locale')
                ->label('Язык контента')
                ->options([
                    'ru' => '🇷🇺 Русский',
                    'kg' => '🇰🇬 Кыргызча',
                ])
                ->default('ru')
                ->reactive(),

            Forms\Components\Select::make('test_id')
                ->relationship('test', 'id')
                ->getOptionLabelFromRecordUsing(fn ($record) => $record->getTranslation('title', 'ru') . ' / ' . $record->getTranslation('title', 'kg'))
                ->required()
                ->label('Тест'),

            Repeater::make('questions_data')
                ->label('Вопросы')
                ->schema([

                    Textarea::make('question')
                        ->label(fn (Get $get) => $get('active_locale') === 'kg' ? 'Суроо' : 'Вопрос')
                        ->required()
                        ->columnSpanFull(),

                    Textarea::make('explanation')
                        ->label(fn (Get $get) => $get('active_locale') === 'kg' ? 'Түшүндүрмө' : 'Пояснение')
                        ->rows(3)
                        ->columnSpanFull(),

                    FileUpload::make('image')
                        ->label('Изображение')
                        ->image(),

                    TextInput::make('video')
                        ->label('Видео'),

                    Repeater::make('answers')
                        ->label('Ответы')
                        ->schema([
                            Textarea::make('answer')
                                ->label(fn (Get $get) => $get('active_locale') === 'kg' ? 'Жооп' : 'Ответ')
                                ->required(),

                            Forms\Components\Toggle::make('is_correct')
                                ->label('Правильный?')
                                ->default(false),
                        ])
                        ->minItems(4)
                        ->maxItems(4)
                        ->columns(1)
                        ->itemLabel(fn ($state) => str($state['answer'] ?? 'Ответ')->limit(20)),

                ])
                ->defaultItems(1)
                ->columnSpanFull()
                ->itemLabel(fn ($state) => str($state['question'] ?? 'Вопрос')->limit(20)),

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
