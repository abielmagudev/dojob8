<x-form-field-horizontal for="nameInput" label="Name">
    <input id="nameInput" type="text" class="form-control {{ bsInputInvalid( $errors->has('name') ) }}" name="name" value="{{ old('name', $category->name) }}" autofocus required>
    <x-form-feedback error="name" />
</x-form-field-horizontal>

<x-form-field-horizontal for="descriptionTextarea" label="Description" label-class="form-label-optional">
    <textarea  id="descriptionTextarea" class="form-control {{ bsInputInvalid( $errors->has('description') ) }}" name="description">{{ old('description', $category->description) }}</textarea>
    <x-form-feedback error="description" />
</x-form-field-horizontal>
