<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestResource\Pages;
use App\Filament\Resources\TestResource\RelationManagers;
use App\Models\Category;
use App\Models\Test;
use CodeWithDennis\FilamentSelectTree\SelectTree;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TestResource extends Resource
{
    protected static ?string $model = Test::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Основная информация')
                    ->schema([
                        SelectTree::make('category_id')
                            ->label('Категория')
                            ->relationship('category', 'name', 'parent_id')
                            ->searchable()
                            ->required()
                            ->placeholder('Выберите категорию'),

                        Tabs::make('Название теста')
                            ->tabs([
                                Tabs\Tab::make('🇷🇺 RU')->schema([
                                    TextInput::make('title.ru')
                                        ->label('Название (RU)')
                                        ->required(),
                                ]),
                                Tabs\Tab::make('🇰🇬 KG')->schema([
                                    TextInput::make('title.kg')
                                        ->label('Аталышы (KG)')
                                        ->required(),
                                ]),
                            ]),
                    ])
                    ->columns(1)
                    ->collapsed(false),

                Section::make('Мультимедиа')
                    ->schema([
                        Forms\Components\FileUpload::make('image')
                            ->label('Изображение')
                            ->image()
                            ->imagePreviewHeight('200')
                            ->hint('Максимум 2MB, PNG/JPG'),
                    ])
                    ->columns(1),

                Section::make('Настройки')
                    ->schema([
                        TextInput::make('duration')
                            ->label('Длительность (в минутах)')
                            ->required()
                            ->numeric()
                            ->minValue(1),
                    ])
                    ->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('category_id')
                    ->label('Категория')
                    ->formatStateUsing(fn ($state) => Category::find($state)?->name ?? 'Нет')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('duration')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('video')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTests::route('/'),
            'create' => Pages\CreateTest::route('/create'),
            'edit' => Pages\EditTest::route('/{record}/edit'),
        ];
    }
}
