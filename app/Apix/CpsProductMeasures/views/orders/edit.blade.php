<p class="h5">{{ $extension->name }}</p>

@include('CpsProductMeasures/views/orders/_product-component')

<div id="cpspmProductsOrder">
    @foreach($products_order as $product_order)
        @include('CpsProductMeasures/views/orders/_product-template', [
            'product' => [
                'text' => $product_order->product->name,
                'value' => $product_order->product_id,
            ],
            'quantity' => [
                'text' => $product_order->quantity,
                'value' => $product_order->quantity
            ],
        ])
    @endforeach

    <?php $products_count = count( old('products', []) ) ?>

    @for($i = 0; $i < $products_count; $i++)
    
        @if( $products_order->contains('product_id', '==', old('products')[$i]) )
            @continue
        @endif

        @if( $product = $products->find( old('products')[$i] ) )   
            @include('CpsProductMeasures/views/orders/_product-template', [
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
</div>

<x-error name="products" />
<x-error name="products.*" />
<x-error name="quantities" />
<x-error name="quantities.*" />

<script src="{{ asset('x-js/cpspm.js') }}" fake></script>
