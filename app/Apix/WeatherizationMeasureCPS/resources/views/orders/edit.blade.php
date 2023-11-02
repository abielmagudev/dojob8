<p class="h5">{{ $extension->name }}</p>
<div id="wmcps-component">
    <div class="row align-items-end mb-3">
        <div class="col">
            <label for="selectProduct" class="form-label">Product</label>
            <select id="selectProduct" class="form-select">
                <option disabled selected label="Choose..."></option>
    
                @foreach($products as $product)
                <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col">
            <label for="inputQuantity" class="form-label">Quantity</label>
            <input id="inputQuantity" class="form-control" type="number" min="1" max="999" step="1">
        </div>
        <div class="col col-sm-2 col-md-1">
            <button class="btn btn-primary w-100" type="button">
                <b>+</b>
            </button>
        </div>
    </div>
    <template>
        @include('WeatherizationMeasureCps/resources/views/orders/template-measure')
    </template>
</div>
<x-error name="measures" />
<div id="wmcps-measures">

    @isset($measures)
    @foreach($measures as $measure)
    @include('WeatherizationMeasureCps/resources/views/orders/template-measure', [
        'product' => [
            'text' => $measure->product->name,
            'value' => $measure->product->id,
        ],
        'quantity' => [
            'text' => $measure->quantity,
            'value' => $measure->quantity
        ],
    ])
    @endforeach
    @endisset


    @if( $products_count = count( old('products', []) ) )
    @for($i = 0; $i < $products_count; $i++)
        
    @if($product = $products->find( old('products')[$i] ) )   
    @include('WeatherizationMeasureCps/resources/views/orders/template-measure', [
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
<script src="{{ asset('x-js/wmcps.js') }}" fake></script>
