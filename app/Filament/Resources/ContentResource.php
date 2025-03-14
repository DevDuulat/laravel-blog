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
                Forms\Components\TextInput::make('title')
                            ->label('Заголовок')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (Set $set, $state) {
                                $set('slug', Str::slug($state));
                            })
                            ->columnSpan(2),

                        Forms\Components\TextInput::make('slug')
                            ->label('Slug')
                            ->required()
                            ->maxLength(255)
                            ->rules([
                                Rule::unique(Content::class, 'slug'),
                            ])
                            ->validationMessages([
                                'unique' => 'Этот slug уже существует. Пожалуйста, выберите другое название категории.',
                            ])
                            ->columnSpan(2),

                        Forms\Components\RichEditor::make('content')
                            ->label('Контент')
                            ->columnSpanFull(),

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

                Forms\Components\Section::make('Meta')
                    ->schema([
                        Forms\Components\TextInput::make('meta_title')
                            ->label('Meta Title')
                            ->required()
                            ->maxLength(255)
                            ->columnSpan(2),

                        Forms\Components\Textarea::make('meta_description')
                            ->label('Meta Description')
                            ->columnSpanFull()
                            ->required(),

                        Forms\Components\Textarea::make('meta_keywords')
                            ->label('Meta Keywords')
                            ->columnSpanFull()
                            ->required(),
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
