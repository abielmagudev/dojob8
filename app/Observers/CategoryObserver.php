<?php

namespace App\Observers;

use App\Models\Category;

class CategoryObserver
{
    public function created(Category $category)
    {
        Category::withoutEvents(function() use ($category) {
            $category->created_id = auth()->id();
            $category->updated_id = auth()->id();
            $category->save();
        });

        $category->history()->create([
            'description' => sprintf("Category <b>{$category->name}</b> was created."),
            'link' => route('categories.show', $category),
            'user_id' => auth()->id(),
        ]);
    }

    public function updated(Category $category)
    {
        Category::withoutEvents(function() use ($category) {
            $category->updated_id = auth()->id();
            $category->save();
        });

        $category->history()->create([
            'description' => sprintf("Category <b>{$category->name}</b> was updated."),
            'link' => route('categories.show', $category),
            'user_id' => auth()->id(),
        ]);
    }

    public function deleted(Category $category)
    {
        $category->history()->delete();

        $category->history()->create([
            'description' => sprintf("Category <b>{$category->name}</b> was deleted."),
            'link' => route('users.show', auth()->id()),
            'user_id' => auth()->id(),
        ]);
    }
}
