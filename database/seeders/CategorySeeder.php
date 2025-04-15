<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name' => [
                'ru' => 'По темам',
                'kg' => 'Тема боюнча',
            ],
            'slug' => [
                'ru' => 'po-temam',
                'kg' => 'tema-boiunca',
            ],
            'category_type' => 'test',
            'is_active' => true,
        ]);

        Category::create([
            'name' => [
                'ru' => 'По билетам',
                'kg' => 'Билеттер боюнча',
            ],
            'slug' => [
                'ru' => 'po-biletam',
                'kg' => 'biletter-boiunca',
            ],
            'category_type' => 'test',
            'is_active' => true,
        ]);

        Category::create([
            'name' => [
                'ru' => 'Теория',
                'kg' => 'Теория',
            ],
            'slug' => [
                'ru' => 'teoriya',
                'kg' => 'teoriya',
            ],
            'category_type' => 'page',
            'is_active' => true,
        ]);

        Category::create([
            'name' => [
                'ru' => 'Дорожные знаки',
                'kg' => 'Жол белгилери',
            ],
            'slug' => [
                'ru' => 'dorozhnye-znaki',
                'kg' => 'zol-belgileri',
            ],
            'category_type' => 'page',
            'is_active' => true,
        ]);

        Category::create([
            'name' => [
                'ru' => 'Дорожная разметка',
                'kg' => 'Жол бетиндеги чийиндер',
            ],
            'slug' => [
                'ru' => 'doroznaia-razmetka',
                'kg' => 'zol-syzyktary',
            ],
            'category_type' => 'page',
            'is_active' => true,
        ]);
    }
}
