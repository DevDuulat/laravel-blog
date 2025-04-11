<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContentResource\Pages;
use App\Filament\Resources\ContentResource\RelationManagers;
use App\Models\Category;
use App\Models\Content;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ContentResource extends Resource
{
    protected static ?string $model = Content::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Основная информация')
                    ->schema([
                        Forms\Components\Select::make('type')
                            ->label('Тип Контента')
                            ->options([
                                'post' => 'Пост',
                                'page' => 'Страница',
                            ])
                            ->required()
                            ->default('post')
                            ->reactive()
                            ->afterStateUpdated(function (Set $set, $state) {
                                $set('category_id', null);
                            })
                            ->columnSpan(2),

                        Forms\Components\Select::make('category_id')
                            ->label('Категория')
                            ->options(function (callable $get) {
                                $type = $get('type');
                                return Category::where('category_type', $type)
                                    ->pluck('name', 'id')
                                    ->toArray();
                            })
                            ->searchable()
                            ->preload()
                            ->required()
                            ->columnSpan(2),

                        Forms\Components\Tabs::make('Переводы')
                            ->columnSpanFull()
                            ->tabs([
                                Forms\Components\Tabs\Tab::make('🇷🇺 RU')->schema([
                                    Forms\Components\TextInput::make('title.ru')->label('Заголовок (RU)')
                                        ->required()
                                        ->maxLength(255)
                                        ->live(onBlur: true)
                                        ->afterStateUpdated(fn(Set $set, $state) => $set('slug.ru', Str::slug($state))),
                                    Forms\Components\TextInput::make('slug.ru')->label('Slug (RU)')
                                        ->required()
                                        ->maxLength(255),
                                    Forms\Components\RichEditor::make('content.ru')->label('Контент (RU)'),
                                    Forms\Components\TextInput::make('meta_title.ru')->label('Meta Title (RU)'),
                                    Forms\Components\Textarea::make('meta_description.ru')->label('Meta Description (RU)'),
                                    Forms\Components\Textarea::make('meta_keywords.ru')->label('Meta Keywords (RU)'),
                                ]),
                                Forms\Components\Tabs\Tab::make('🇰🇬 KY')->schema([
                                    Forms\Components\TextInput::make('title.ky')->label('Заголовок (KY)')
                                        ->maxLength(255)
                                        ->live(onBlur: true)
                                        ->afterStateUpdated(fn(Set $set, $state) => $set('slug.ky', Str::slug($state))),
                                    Forms\Components\TextInput::make('slug.ky')->label('Slug (KY)')
                                        ->maxLength(255),
                                    Forms\Components\RichEditor::make('content.ky')->label('Контент (KY)'),
                                    Forms\Components\TextInput::make('meta_title.ky')->label('Meta Title (KY)'),
                                    Forms\Components\Textarea::make('meta_description.ky')->label('Meta Description (KY)'),
                                    Forms\Components\Textarea::make('meta_keywords.ky')->label('Meta Keywords (KY)'),
                                ]),
                                Forms\Components\Tabs\Tab::make('🇺🇿 UZ')->schema([
                                    Forms\Components\TextInput::make('title.uz')->label('Заголовок (UZ)')
                                        ->maxLength(255)
                                        ->live(onBlur: true)
                                        ->afterStateUpdated(fn(Set $set, $state) => $set('slug.uz', Str::slug($state))),
                                    Forms\Components\TextInput::make('slug.uz')->label('Slug (UZ)')
                                        ->maxLength(255),
                                    Forms\Components\RichEditor::make('content.uz')->label('Контент (UZ)'),
                                    Forms\Components\TextInput::make('meta_title.uz')->label('Meta Title (UZ)'),
                                    Forms\Components\Textarea::make('meta_description.uz')->label('Meta Description (UZ)'),
                                    Forms\Components\Textarea::make('meta_keywords.uz')->label('Meta Keywords (UZ)'),
                                ]),
                            ]),

                        Forms\Components\FileUpload::make('cover')
                            ->label('Обложка')
                            ->image()
                            ->columnSpan(2),

                        Forms\Components\FileUpload::make('banner_image')
                            ->label('Изображение баннера')
                            ->image()
                            ->columnSpan(2),

                        Forms\Components\Select::make('status')
                            ->label('Статус')
                            ->options([
                                'draft' => 'Черновик',
                                'published' => 'Опубликовано',
                                'archived' => 'Архивировано',
                            ])
                            ->required()
                            ->default('draft')
                            ->columnSpan(2),

                        Forms\Components\DateTimePicker::make('published_at')
                            ->label('Дата публикации')
                            ->required()
                            ->default(now())
                            ->columnSpan(2),
                    ]),
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('cover')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('banner_image'),
                Tables\Columns\TextColumn::make('category_id')
                    ->label('Категория')
                    ->formatStateUsing(fn ($state) => Category::find($state)?->name ?? 'Нет')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),

                Tables\Columns\TextColumn::make('published_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('likes_count')
                    ->formatStateUsing(fn ($state) => "❤️ {$state}")
                    ->sortable(),

                Tables\Columns\TextColumn::make('comments_count')
                    ->formatStateUsing(fn ($state) => "💬 {$state}")
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Статус')
                    ->sortable()
                    ->searchable()
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'draft' => 'gray',
                        'published' => 'success',
                        'archived' => 'danger',
                        default => 'secondary',
                    }),
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
            'index' => Pages\ListContents::route('/'),
            'create' => Pages\CreateContent::route('/create'),
            'edit' => Pages\EditContent::route('/{record}/edit'),
        ];
    }
}
