<?php

namespace Database\Seeders\Development;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::factory( mt_rand(1,20) )->create();
    }
}
