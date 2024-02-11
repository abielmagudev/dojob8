<div class="mb-3">
    <label for="nameInput" class="form-label">Name</label>
    <input id="nameInput" type="text" class="form-control {{ bsInputInvalid( $errors->has('name') ) }}" name="name" value="{{ old('name', $agency->name) }}" autofocus required>
    <x-form-feedback error="name" />
</div>
<div class="mb-3">
    <label for="nameTextarea" class="form-label form-label-optional">Notes</label>
    <textarea id="nameTextarea" class="form-control {{ bsInputInvalid( $errors->has('notes') ) }}" name="notes">{{ old('notes', $agency->notes) }}</textarea>
    <x-form-feedback error="notes" />
</div>
