<?php 

namespace App\Models\Product\Services;

use App\Models\Product;

class ProductCatalogService
{
    public static function all()
    {
        return self::uncategorized()->toBase()->merge(
            self::categorized()
        );
    }

    public static function uncategorized()
    {
        return collect([
            'Uncategorized' => Product::uncategorized()->get()
        ]);
    }

    public static function categorized()
    {
        return Product::with('category')
        ->categorized()
        ->orderBy('name')
        ->get()
        ->groupBy('category_name')
        ->sortBy(fn($products, $categorized) => $categorized);
    }
}
