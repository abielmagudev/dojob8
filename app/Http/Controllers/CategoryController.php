<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return view('categories.index')->with('categories', Category::withCount('products')->get());
    }

    public function create()
    {
        return view('categories.create')->with('category', new Category);
    }

    public function store(CategoryStoreRequest $request)
    {
        if(! $category = Category::create( $request->validated() ) ) {
            return back()->with('danger', 'Error creating category, try again please...');
        }

        return redirect()->route('categories.index')->with('success', "Category <b>{$category->name}</b> created");
    }

    public function show(Category $category)
    {
        $category->load('products');
        
        return view('categories.show')->with('category', $category);
    }

    public function edit(Category $category)
    {
        return view('categories.edit')->with('category', $category);
    }

    public function update(CategoryUpdateRequest $request, Category $category)
    {
        if(! $category->fill( $request->validated() )->save() ) {
            return back()->with('danger', 'Error updating category, try again please...');
        }

        return redirect()->route('categories.edit', $category)->with('success', "Category <b>{$category->name}</b> updated");
    }

    public function destroy(Category $category)
    {
        if(! $category->delete() ) {
            return back()->with('danger', 'Error deleting category, try again please...');
        }

        return redirect()->route('categories.index')->with('success', "Category <b>{$category->name}</b> deleted");
    }
}
