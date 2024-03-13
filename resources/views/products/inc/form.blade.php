<x-form-field-horizontal for="nameInput" label="Name">
    <input id="nameInput" type="text" class="form-control {{ bsInputInvalid( $errors->has('name') ) }}" name="name" value="{{ old('name', $product->name) }}" autofocus required>
    <x-form-feedback error="name" />
</x-form-field-horizontal>

<x-form-field-horizontal  for="materialPriceInput" label="Material price">
    <input id="materialPriceInput" type="number" class="form-control {{ bsInputInvalid( $errors->has('material_price') ) }}" name="material_price" value="{{ old('material_price', $product->material_price) }}" min="0" step="0.01" required>
    <x-form-feedback error="material_price" />
</x-form-field-horizontal>

<x-form-field-horizontal for="laborPriceInput" label="Labor price">
    <input id="laborPriceInput" type="number" class="form-control {{ bsInputInvalid( $errors->has('labor_price') ) }}" name="labor_price" value="{{ old('labor_price', $product->labor_price) }}" min="0" step="0.01" required>
    <x-form-feedback error="labor_price" />
</x-form-field-horizontal>

<x-form-field-horizontal for="descriptionTextarea" label="Description" label-class="form-label-optional">
    <textarea id="descriptionTextarea" name="description" class="form-control {{ bsInputInvalid( $errors->has('description') ) }}">{{ old('description', $product->description) }}</textarea>
    <x-form-feedback error="labor_price" />
</x-form-field-horizontal>

<x-form-field-horizontal for="itemPriceIdInput" label="Item Price ID" label-class="form-label-optional">
    <input id="itemPriceIdInput" type="text" class="form-control {{ bsInputInvalid( $errors->has('item_price_id') ) }}" name="item_price_id" value="{{ old('item_price_id', $product->item_price_id) }}">
    <x-form-feedback error="item_price_id" />
</x-form-field-horizontal>
