<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Recipe;
use App\Models\Category;
use App\Models\User;

class RecipeSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all();
        
        if ($categories->isEmpty()) {
            $this->command->warn('Категории не найдены. Сначала запустите CategorySeeder.');
            return;
        }

        // Создаем пользователей если их нет
        if (User::count() < 3) {
            User::factory()->count(3)->create();
        }

        // Создаем рецепты для каждой категории
        foreach ($categories as $category) {
            // По 8 рецептов на каждую категорию
            Recipe::factory()
                ->count(8)
                ->create([
                    'category_id' => $category->id,
                ]);
        }

        // Создаем еще несколько рецептов без категории
        Recipe::factory()->count(5)->create([
            'category_id' => null,
        ]);

        $this->command->info('Создано ' . Recipe::count() . ' рецептов');
    }
}
