<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Recipe;
class RecipeSeeder extends Seeder {
    public function run() {
        Recipe::factory()->count(10)->create();
    }
}
