<p class="h5">{{ $extension->name }}</p>

@include('WeatherizationMeasureCps/resources/views/orders/_product-component')

<div id="wmcpsProductsOrder">
    @foreach($products_order as $product_order)
    @include('WeatherizationMeasureCps/resources/views/orders/_product-template', [
        'product' => [
            'text' => $product_order->measure->name,
            'value' => $product_order->measure_id,
        ],
        'quantity' => [
            'text' => $product_order->quantity,
            'value' => $product_order->quantity
        ],
    ])
    @endforeach

    @php $products_count = count( old('products', []) ) @endphp
    @for($i = 0; $i < $products_count; $i++)
        
    @if($product = $products->find( old('products')[$i] ) )   
    @include('WeatherizationMeasureCps/resources/views/orders/_product-template', [
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
<x-error name="quantities" />

<script src="{{ asset('x-js/wmcps.js') }}" fake></script>
