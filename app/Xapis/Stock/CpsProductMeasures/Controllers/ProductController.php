<?php

namespace App\Xapis\Stock\CpsProductMeasures\Controllers;

use App\Xapis\Stock\CpsProductMeasures\Models\Category;
use App\Xapis\Stock\CpsProductMeasures\Models\Product;
use App\Xapis\Stock\CpsProductMeasures\Requests\ProductSaveRequest;
use App\Http\Controllers\Controller;
use App\Models\Extension;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Extension $extension)
    {
        return view('CpsProductMeasures/views/products/index', [
            'extension' => $extension,
            'products' => Product::with('category')->get(),
        ]);
    }

    public function create(Extension $extension)
    {
        return view('CpsProductMeasures/views/products/create', [
            'extension' => $extension,
            'categories' => Category::all(),
            'product' => new Product,
            'next_item_price_id' => (Product::all())->max('item_price_id') + 1,
        ]);
    }

    public function store(ProductSaveRequest $request, Extension $extension)
    {
        if(! $product = Product::create( $request->validated() ) )
            return back()->with('danger', 'Error saving product, try again please');

        $message = "Product <b>{$product->name}</b> saved";

        if( $request->after_saving == 1 ) {
            return redirect()->route('extensions.create', [$extension, 'sub' => 'products'])->withInput($request->only('category'))->with('success', $message);
        }

        return redirect()->route('extensions.show', $extension)->with('success', $message);
    }

    public function edit(Request $request, Extension $extension)
    {
        $product = Product::findOrFail($request->product);

        return view('CpsProductMeasures/views/products/edit', [
            'extension' => $extension,
            'categories' => Category::all(),
            'product' => $product,
            'next_item_price_id' => $product->item_price_id,
        ]);
    }

    public function update(ProductSaveRequest $request, Extension $extension)
    {
        $product = $request->cache['product'];

        if(! $product->fill( $request->validated() )->save() ) {
            return back()->with('danger', 'Error updating product, try again please');
        }

        return redirect()->route('extensions.edit', [$extension, 'sub' => 'products', 'product' => $product->id])->with('success', "Product {$product->name} updated");
    }

    public function destroy(Request $request, Extension $extension)
    {
        //
    }
}
