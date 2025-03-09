<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use TomatoPHP\FilamentCms\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => ['en' => 'Road Signs', 'ru' => 'Дорожные знаки'],
                'slug' => 'road-signs',
                'description' => ['en' => 'Information about road signs', 'ru' => 'Информация о дорожных знаках'],
                'is_active' => true,
                'show_in_menu' => true,
            ],
            [
                'name' => ['en' => 'Road Markings', 'ru' => 'Дорожная разметка'],
                'slug' => 'road-markings',
                'description' => ['en' => 'Details about road markings', 'ru' => 'Подробности о дорожной разметке'],
                'is_active' => true,
                'show_in_menu' => true,
            ],
            [
                'name' => ['en' => 'Vehicle Admission Rules', 'ru' => 'Основные положения по допуску ТС к эксплуатации'],
                'slug' => 'vehicle-admission',
                'description' => ['en' => 'Regulations for vehicle usage', 'ru' => 'Правила использования транспортных средств'],
                'is_active' => true,
                'show_in_menu' => true,
            ],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }


    }
}
