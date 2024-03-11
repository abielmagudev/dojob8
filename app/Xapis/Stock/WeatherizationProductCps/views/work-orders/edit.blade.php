<p class="h5">{{ $extension->name }}</p>

@include('WeatherizationProductCps/views/work-orders/_product-component')

<div id="wcpsProductsWorkOrder">
    @foreach($work_order_products as $work_order_product)
        @include('WeatherizationProductCps/views/work-orders/_product-template', [
            'product' => [
                'text' => $work_order_product->product->name,
                'value' => $work_order_product->product_id,
            ],
            'quantity' => [
                'text' => $work_order_product->quantity,
                'value' => $work_order_product->quantity
            ],
            'indications' => [
                'text' => $work_order_product->indications,
                'value' => $work_order_product->indications
            ],
        ])
    @endforeach

    <?php $products_count = count( old('products', []) ) ?>

    @for($i = 0; $i < $products_count; $i++)
    
        @if( $products_order->contains('product_id', '==', old('products')[$i]) )
            @continue
        @endif

        @if( $product = $products->find( old('products')[$i] ) )   
            @include('WeatherizationProductCps/views/orders/_product-template', [
                'product' => [
                    'text' => $product->name,
                    'value' => $product->id,
                ],
                'quantity' => [
                    'text' => old('quantities')[$i] ?? 0,
                    'value' => old('quantities')[$i] ?? 0,
                ],
                'indications' => [
                    'text' => old('indications')[$i] ?? 0,
                    'value' => old('indications')[$i] ?? 0,
                ],
            ])
        @endif

    @endfor 
</div>

<x-form-feedback error="products" />
<x-form-feedback error="products.*" />
<x-form-feedback error="quantities" />
<x-form-feedback error="quantities.*" />

<script src="{{ asset('storage/xapis/wzprodcps.js') }}" fake></script>
