@csrf
<x-custom.form-control-horizontal>
    <x-slot name="label">
        <label for="nameInput" class="form-label">Name</label>
    </x-slot>
    <input type="text" class="form-control" name="name" value="{{ old('name', $crew->name) }}" required>
</x-custom.form-control-horizontal>

<x-custom.form-control-horizontal>
    <x-slot name="label">
        <label for="descriptionTextarea" class="form-label form-label-optional">Description</label>
    </x-slot>
    <textarea id="descriptionTextarea" rows="3" class="form-control" name="description">{{ old('description', $crew->description) }}</textarea>
</x-custom.form-control-horizontal>

<x-custom.form-control-horizontal>
    <x-slot name="label">
        <label for="colorInput" class="form-label form-label-optional">Color</label>
    </x-slot>
    <input type="color" class="form-control form-control-color" style="height:36px" name="color" value="{{ old('color', $crew->color) }}">
</x-custom.form-control-horizontal>
<br>

@if( $crew->id <> null ) 
<div class="form-check form-switch">
    <input class="form-check-input" id="isActiveSwitch" type="checkbox" role="switch" name="is_active" value="1" {{ isChecked( old('is_active', $crew->is_active) == 1 ) }}>
    <label class="form-check-label" for="isActiveSwitch"><b>Active.</b> If it is deactivated, it cannot be used in new orders and the members of this crew will be removed.</label>
</div>
<x-error name="is_active" />
@endif
