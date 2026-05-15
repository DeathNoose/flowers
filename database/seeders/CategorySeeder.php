<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::truncate();
        
        $categories = [
            [
                'name' => 'Букеты',
                'slug' => 'bukety',
                'description' => 'Готовые композиции на черном фоне. Идеальный подарок для любого случая.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Композиции',
                'slug' => 'kompozitsii',
                'description' => 'Авторские работы в коробках и кашпо. Стильное решение для интерьера.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Цветы поштучно',
                'slug' => 'po-shtuchno',
                'description' => 'Эксклюзивные сорта для ваших идей. Создайте свой уникальный букет.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
        
        $this->command->info('✅ Добавлено категорий: ' . Category::count());
    }
}