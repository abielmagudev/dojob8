<?php

namespace App\Observers;

use App\Models\Product;

class ProductObserver
{
    public function created(Product $product)
    {
        Product::withoutEvents(function() use ($product) {
            $product->created_id = auth()->id();
            $product->updated_id = auth()->id();
            $product->save();
        });

        $product->history()->create([
            'description' => sprintf("Product <b>{$product->name}</b> was created."),
            'link' => route('products.show', $product),
            'user_id' => auth()->id(),
        ]);
    }

    public function updated(Product $product)
    {
        Product::withoutEvents(function() use ($product) {
            $product->updated_id = auth()->id();
            $product->save();
        });

        $product->history()->create([
            'description' => sprintf("Product <b>{$product->name}</b> was updated."),
            'link' => route('products.show', $product),
            'user_id' => auth()->id(),
        ]);
    }

    public function deleting(Product $product)
    {
        Product::withoutEvents(function() use ($product) {
            $product->deleted_id = auth()->id();
            $product->save();
        });
    }

    public function deleted(Product $product)
    {
        $product->history()->create([
            'description' => sprintf("Product <b>{$product->name}</b> was deleted."),
            'user_id' => auth()->id(),
        ]);
    }
}
