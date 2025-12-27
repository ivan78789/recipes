<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Recipe;

class FavoriteSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();
        $recipes = Recipe::all();

        if ($users->isEmpty() || $recipes->isEmpty()) {
            return;
        }

        // Для каждого пользователя добавим несколько случайных избранных
        foreach ($users as $user) {
            $sample = $recipes->random(min(5, $recipes->count()))->pluck('id')->toArray();
            $user->favorites()->syncWithoutDetaching($sample);
        }
    }
}
