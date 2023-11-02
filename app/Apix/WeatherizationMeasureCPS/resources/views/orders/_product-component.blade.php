<div id="wmcpsProductsComponent">
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
        @include('WeatherizationMeasureCps/resources/views/orders/_product-template')
    </template>
</div>
