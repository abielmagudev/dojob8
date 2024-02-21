<?php

namespace App\Xapis\Stock\WeatherizationCps\Controllers;

use App\Xapis\Stock\WeatherizationCps\Models\Category;
use App\Xapis\Stock\WeatherizationCps\Requests\CategorySaveRequest;
use App\Http\Controllers\Controller;
use App\Models\Extension;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Extension $extension)
    {
        return view('WeatherizationCps/views/categories/index', [
            'extension' => $extension,
            'categories' => Category::withCount('products')->get(),
        ]);
    }

    public function create(Extension $extension)
    {
        return view('WeatherizationCps/views/categories/create', [
            'extension' => $extension,
            'category' => new Category,
        ]);
    }

    public function store(CategorySaveRequest $request, Extension $extension)
    {
        if(! $category = Category::create( $request->validated() ) ) {
            return back()->with('danger', 'Error saving category, try again please');
        }

        return redirect()->route('extensions.create', [$extension, 'sub' => 'products'])->with('success', "Category <b>{$category->name}</b> saved");
    }

    public function edit(Request $request, Extension $extension)
    {
        $category = Category::findOrFail($request->category);

        return view('WeatherizationCps/views/categories/edit', [
            'extension' => $extension,
            'category' => $category,
        ]);
    }

    public function update(CategorySaveRequest $request, Extension $extension)
    {
        $category = $request->cache['category'];

        if(! $category->fill( $request->validated() )->save() ) {
            return back()->with('danger', 'Error updating, try again please');
        }

        return redirect()->route('extensions.edit', [$extension, 'sub' => 'categories', 'category' => $category->id])->with('success', "Category <b>{$category->name}</b> updated");
    }

    public function destroy(Request $request, Extension $extension)
    {
        // 
    }
}
