<p class="h5">{{ $extension->name }}</p>

@include('CpsProductMeasures/views/work-orders/_product-component')

<div id="cpspmProductsWorkOrder">
    @if( $products_count = count( old('products', []) ) )
    @for($i = 0; $i < $products_count; $i++)
        
    @if($product = $products->find( old('products')[$i] ) )   
    @include('CpsProductMeasures/views/work-orders/_product-template', [
        'product' => [
            'text' => $product->name,
            'value' => $product->id,
        ],
        'quantity' => [
            'text' => old('quantities')[$i] ?? 0,
            'value' => old('quantities')[$i] ?? 0,
        ],
    ])
    @endif

    @endfor 
    @endif
</div>

<x-form-feedback error="products" />
<x-form-feedback error="products.*" />
<x-form-feedback error="quantities" />
<x-form-feedback error="quantities.*" />

<script src="{{ asset('x-js/cpspm.js') }}" fake></script>