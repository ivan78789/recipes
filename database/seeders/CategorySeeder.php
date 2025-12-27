<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Завтрак',
                'slug' => 'zavtrak',
                'image' => '/img/image/zavtrack.jpg',
            ],
            [
                'name' => 'Обед',
                'slug' => 'obed',
                'image' => '/img/image/obed.jpg',
            ],
            [
                'name' => 'Ужин',
                'slug' => 'uzhin',
                'image' => '/img/image/yzhin.jpg',
            ],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }
    }
}

