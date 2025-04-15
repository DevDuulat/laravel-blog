<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Filament\Resources\CategoryResource\RelationManagers;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('parent_id')
                    ->label('Родительская категория')
                    ->options(Category::pluck('name', 'id'))
                    ->searchable()
                    ->placeholder('Выберите родительскую категорию')
                    ->nullable()
                    ->reactive()
                    ->afterStateUpdated(fn (callable $set, $state) =>
                    $set('category_type', $state ? Category::find($state)?->category_type : 'posts')
                    ),

                Forms\Components\Select::make('category_type')
                    ->label('Тип категории')
                    ->options([
                        'post' => 'Посты',
                        'page' => 'Страницы',
                        'test' => 'Тесты',
                    ])
                    ->required()
                    ->default('posts')
                    ->hidden(fn (callable $get) => !is_null($get('parent_id'))),

                Tabs::make('Translations')
                    ->tabs([
                        Tabs\Tab::make('🇷🇺 RU')
                            ->schema([
                                Forms\Components\TextInput::make('name.ru')
                                    ->label('Название')
                                    ->required()
                                    ->maxLength(255)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn (Set $set, $state) =>
                                    $set('slug.ru', Str::slug($state))
                                    ),

                                Forms\Components\TextInput::make('slug.ru')
                                    ->label('Slug')
                                    ->required()
                                    ->maxLength(255)
                                    ->validationMessages([
                                        'unique' => 'Этот slug уже используется.',
                                    ]),
                            ]),

                        Tabs\Tab::make('🇰🇬 KG')
                            ->schema([
                                Forms\Components\TextInput::make('name.kg')
                                    ->label('Аталышы')
                                    ->maxLength(255)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn (Set $set, $state) =>
                                    $set('slug.kg', Str::slug($state))
                                    ),

                                Forms\Components\TextInput::make('slug.kg')
                                    ->label('Slug')
                                    ->maxLength(255),
                            ]),
                    ]),
                Forms\Components\FileUpload::make('banner_image')
                    ->label('Баннер')
                    ->image()
                    ->directory('categories'),

                Forms\Components\Toggle::make('is_active')
                    ->label('Активность')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('banner_image')
                    ->label('Баннер'),

                Tables\Columns\TextColumn::make('parent_id')
                    ->label('Родительская категория')
                    ->formatStateUsing(fn ($state) => Category::find($state)?->name ?? 'Нет')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('name')
                    ->label('Название')
                    ->searchable(),

                Tables\Columns\TextColumn::make('slug')
                    ->label('Slug')
                    ->searchable(),

                Tables\Columns\TextColumn::make('category_type')
                    ->label('Тип категории')
                    ->searchable(),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Активность')
                    ->boolean(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Дата создания')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Дата обновления')
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
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
