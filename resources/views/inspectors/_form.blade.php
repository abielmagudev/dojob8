@csrf
<div class="mb-3">
    <label for="nameInput" class="form-label">Name</label>
    <input id="nameInput" class="form-control {{ bsInputInvalid( $errors->has('name') ) }}" type="text" name="name" value="{{ old('name', $inspector->name) }}" required>
    <x-form-feedback error="name" />
</div>
<div class="mb-3">
    <label for="notesTextarea" class="form-label form-label-optional {{ bsInputInvalid( $errors->has('notes') ) }}">Notes</label>
    <textarea id="notesTextarea" class="form-control" name="notes" rows="3">{{ old('notes', $inspector->notes) }}</textarea>
    <x-form-feedback error="notes" />
</div>
