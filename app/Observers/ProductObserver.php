<?php

namespace App\Observers;

use App\Models\Product;

class ProductObserver
{
    public function created(Product $product)
    {
        Product::withoutEvents(function() use ($product) {
            $product->created_by = auth()->id();
            $product->updated_by = auth()->id();
            $product->save();
        });

        $product->history()->create([
            'description' => sprintf("Product <em>{$product->name}</em> was created."),
            'link' => route('products.show', $product),
            'user_id' => auth()->id(),
        ]);
    }

    public function updated(Product $product)
    {
        Product::withoutEvents(function() use ($product) {
            $product->updated_by = auth()->id();
            $product->save();
        });

        $product->history()->create([
            'description' => sprintf("Product <em>{$product->name}</em> was updated."),
            'link' => route('products.show', $product),
            'user_id' => auth()->id(),
        ]);
    }

    public function deleted(Product $product)
    {
        Product::withoutEvents(function() use ($product) {
            $product->deleted_by = auth()->id();
            $product->save();
        });

        $product->history()->create([
            'description' => sprintf("Product <em>{$product->name}</em> was deleted."),
            'user_id' => auth()->id(),
        ]);
    }

    public function restored(Product $product)
    {
        //
    }

    public function forceDeleted(Product $product)
    {
        //
    }
}
