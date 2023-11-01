<p class="h5">{{ $extension->name }}</p>
<div class="row align-items-end" id="wmcps-component">
    <div class="col-sm">
        <label for="selectProduct" class="form-label">Product</label>
        <select id="selectProduct" class="form-select">
            <option disabled selected label="Choose..."></option>

            @foreach($products as $product)
            <option value="{{ $product->id }}">{{ $product->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-sm">
        <label for="inputQuantity" class="form-label">Quantity</label>
        <input id="inputQuantity" class="form-control" type="number" min="1" max="999" step="1">
    </div>
    <div class="col-sm col-sm-1">
        <button class="btn btn-primary w-100" type="button">
            <b>+</b>
        </button>
    </div>
</div>
<div id="wmcps-products"></div>
<x-error name="measures" />
<script src="{{ asset('x-js/wmcps.js') }}" fake></script>
