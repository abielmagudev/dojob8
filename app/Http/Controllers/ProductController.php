<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Product::class, 'product');
    }

    public function index(Request $request)
    {
        $products = Product::orderBy('id', 'desc')
        ->orderByRaw('item_price_id IS NULL asc')
        ->orderBy('item_price_id', 'asc')
        ->paginate(35)
        ->appends( $request->query() );

        return view('products.index', [
            'products' => $products,
        ]);
    }

    public function create()
    {
        return view('products.create', [
            'product' => new Product,
            'categories' => Category::all(),
        ]);
    }

    public function store(ProductStoreRequest $request)
    {
        if(! $product = Product::create( $request->validated() ) ) {
            return back()->with('danger', 'Error creating product, try again please...');
        }

        return redirect()->route('products.index')->with('success', "Product <b>{$product->name}</b> created");
    }

    public function show(Product $product)
    {
        return view('products.show', [
            'product' => $product,
        ]);
    }

    public function edit(Product $product)
    {
        return view('products.edit', [
            'product' => $product,
            'categories' => Category::all(),
        ]);
    }

    public function update(ProductUpdateRequest $request, Product $product)
    {
        if(! $product->fill( $request->validated() )->save() ) {
            return back()->with('danger', 'Error updating product, try again please...');
        }

        return redirect()->route('products.edit', $product)->with('success', "Product <b>{$product->name}</b> updated");
    }

    public function destroy(Product $product)
    {
        if(! $product->delete() ) {
            return back()->with('danger', 'Error deleting product, try again please...');
        }

        return redirect()->route('products.index')->with('success', "Product <b>{$product->name}</b> deleted");
    }
}
