@csrf
<div class="mb-3">
    <label for="" class="form-label">Name</label>
    <input type="text" class="form-control {{ bsInputInvalid( $errors->has('name') ) }}" name="name" value="{{ old('name', $category->name) }}" required>
    <x-form-feedback error="name" />
</div>
