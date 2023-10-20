<div class="mb-3">
    <label for="numberItemPrice" class="form-label">Item</label>
    <input type="number" name="item_price_id" value="{{ old('item_price_id', $next_item_price_id) }}" class="form-control" id="numberItemPrice" min="1" step="1" placeholder="Price ID..." required>
    <x-error name="item_price_id" />
</div>
<div class="mb-3">
    <label for="inputName" class="form-label">Name</label>
    <input type="text" name="name" value="{{ old('name', $measure->name) }}" class="form-control" id="inputName" required>
    <x-error name="name" />
</div>
<div class="mb-3">
    <label for="numberMaterialPrice" class="form-label">Material price</label>
    <input type="number" name="material_price" value="{{ old('material_price', $measure->material_price) }}" class="form-control" id="numberMaterialPrice" min="0.01" max="999999.99" step="0.01" required>
    <x-error name="material_price" />
</div>
<div class="mb-3">
    <label for="numberLaborPrice" class="form-label">Labor price</label>
    <input type="number" name="labor_price" value="{{ old('labor_price', $measure->labor_price) }}" class="form-control" id="numberLaborPrice" min="0.01" max="999999.99" step="0.01" required>
    <x-error name="labor_price" />
</div>
@csrf
