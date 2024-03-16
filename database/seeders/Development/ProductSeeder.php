<?php

namespace Database\Seeders\Development;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = Category::all();

        $products = Product::factory( mt_rand(1,100) )->make();

        $products->each(function($p) use ($categories) {
            $p->category_id = random_int(0,1) ? $categories->random()->id : null;
            $p->save();
        });
    }
}
