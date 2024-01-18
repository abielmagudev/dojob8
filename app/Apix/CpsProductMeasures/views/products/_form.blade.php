<div class="mb-3">
    <label for="categorySelect" class="form-label">Category</label>
    <select name="category" id="categorySelect" class="form-select" required>
        <option disabled selected label="Choose..."></option>
        @foreach($categories as $category)
        <option value="{{ $category->id }}" {{ isSelected( old('category', $product->category_id) == $category->id ) }}>{{ $category->name }}</option>
        @endforeach
    </select>
</div>
<div class="mb-3">
    <label for="numberItemPrice" class="form-label">Item price ID</label>
    <input type="number" name="item_price_id" value="{{ old('item_price_id', $next_item_price_id) }}" class="form-control {{ bsInputInvalid( $errors->has('item_price_id') ) }}" id="numberItemPrice" min="1" step="1" required>
    <x-form-feedback error="item_price_id" />
</div>
<div class="mb-3">
    <label for="inputName" class="form-label">Name</label>
    <input type="text" name="name" value="{{ old('name', $product->name) }}" class="form-control {{ bsInputInvalid( $errors->has('name') ) }}" id="inputName" placeholder="Product or service" required>
    <x-form-feedback error="name" />
</div>
<div class="mb-3">
    <label for="numberMaterialPrice" class="form-label">Material price</label>
    <input type="number" name="material_price" value="{{ old('material_price', $product->material_price) }}" class="form-control {{ bsInputInvalid( $errors->has('material_price') ) }}" id="numberMaterialPrice" min="0.01" max="999999.99" step="0.01" placeholder="0.00" required>
    <x-form-feedback error="material_price" />
</div>
<div class="mb-3">
    <label for="numberLaborPrice" class="form-label">Labor price</label>
    <input type="number" name="labor_price" value="{{ old('labor_price', $product->labor_price) }}" class="form-control {{ bsInputInvalid( $errors->has('labor_price') ) }}" id="numberLaborPrice" min="0.01" max="999999.99" step="0.01" placeholder="0.00" required>
    <x-form-feedback error="labor_price" />
</div>
<div class="mb-3">
    <label for="textareaNotes" class="form-label">
        <span>Notes</span>
        <small class="text-secondary">(Optional)</small>
    </label>
    <textarea id="textareaNotes" class="form-control {{ bsInputInvalid( $errors->has('notes') ) }}" rows="3" name="notes">{{ old('notes', $product->notes) }}</textarea>
    <x-form-feedback error="notes" />
</div>
@csrf
