<p class="h5">{{ $extension->name }}</p>

@include('WeatherizationMeasureCps/resources/views/work-orders/_product-component')

<div id="wmcpsProductsWorkOrder">
    @foreach($work_order_products as $work_order_product)
        @include('WeatherizationMeasureCps/resources/views/work-orders/_product-template', [
            'product' => [
                'text' => $work_order_product->measure->name,
                'value' => $work_order_product->measure_id,
            ],
            'quantity' => [
                'text' => $work_order_product->quantity,
                'value' => $work_order_product->quantity
            ],
        ])
    @endforeach

    <?php $products_count = count( old('products', []) ) ?>

    @for($i = 0; $i < $products_count; $i++)
    
        @if( $products_order->contains('measure_id', '==', old('products')[$i]) )
            @continue
        @endif

        @if( $product = $products->find( old('products')[$i] ) )   
            @include('WeatherizationMeasureCps/resources/views/work-orders/_product-template', [
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

<script src="{{ asset('x-js/wmcps.js') }}" fake></script>
