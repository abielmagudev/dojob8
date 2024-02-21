<x-form-field-horizontal for="inputName" label="Name">
    <input type="text" name="name" value="{{ old('name', $product->name) }}" class="form-control {{ bsInputInvalid( $errors->has('name') ) }}" id="inputName" autofocus required>
    <x-form-feedback error="name" />
</x-form-field-horizontal>

<x-form-field-horizontal for="categorySelect" label="Category">
    <select name="category" id="categorySelect" class="form-select">
        <option selected label="Without category"></option>
        @foreach($categories as $category)
        <option value="{{ $category->id }}" {{ isSelected( old('category', $product->category_id) == $category->id ) }}>{{ $category->name }}</option>
        @endforeach
    </select>
    <div class="d-flex justify-content-between">
        <div>
            <x-form-feedback error="category" />
        </div>
        <div>
            <a href="{{ route('extensions.create', [$extension, 'sub' => 'categories']) }}" class="small">New category</a>
        </div>
    </div>
</x-form-field-horizontal>

<x-form-field-horizontal for="inputItemPriceId" label="Item price ID">
    <input id="inputItemPriceId" type="text" name="item_price_id" value="{{ old('item_price_id', $product->item_price_id) }}" class="form-control {{ bsInputInvalid( $errors->has('item_price_id') ) }}" required>
    <x-form-feedback error="item_price_id" />
</x-form-field-horizontal>

<x-form-field-horizontal for="inputItnumberMaterialPriceemPriceId" label="Material price">
    <input type="number" name="material_price" value="{{ old('material_price', $product->material_price) }}" class="form-control {{ bsInputInvalid( $errors->has('material_price') ) }}" id="numberMaterialPrice" min="0.01" max="999999.99" step="0.01" placeholder="0.00" required>
    <x-form-feedback error="material_price" />
</x-form-field-horizontal>

<x-form-field-horizontal for="numberLaborPrice" label="Labor price">
    <input type="number" name="labor_price" value="{{ old('labor_price', $product->labor_price) }}" class="form-control {{ bsInputInvalid( $errors->has('labor_price') ) }}" id="numberLaborPrice" min="0.01" max="999999.99" step="0.01" placeholder="0.00" required>
    <x-form-feedback error="labor_price" />
</x-form-field-horizontal>

<x-form-field-horizontal for="textareaNotes" label="Notes" label-class="form-label-optional">
    <textarea id="textareaNotes" class="form-control {{ bsInputInvalid( $errors->has('notes') ) }}" rows="3" name="notes">{{ old('notes', $product->notes) }}</textarea>
    <x-form-feedback error="notes" />
</x-form-field-horizontal>
