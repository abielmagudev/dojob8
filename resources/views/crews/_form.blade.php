@csrf
<x-form-control-horizontal>
    <x-slot name="label">
        <label for="nameInput" class="form-label">Name</label>
    </x-slot>
    <input type="text" class="form-control" name="name" value="{{ old('name', $crew->name) }}" required>
    <x-error name="name" />
</x-form-control-horizontal>

<x-form-control-horizontal>
    <x-slot name="label">
        <label for="descriptionTextarea" class="form-label form-label-optional">Description</label>
    </x-slot>
    <textarea id="descriptionTextarea" rows="3" class="form-control" name="description">{{ old('description', $crew->description) }}</textarea>
    <x-error name="description" />
</x-form-control-horizontal>

<x-form-control-horizontal>
    <x-slot name="label">
        <label class="form-label">Colors</label>
    </x-slot>

    <div class="row">
        <div class="col-md">
            <input id="backgroundColorInput" type="color" class="form-control form-control-color w-100" name="background_color" value="{{ old('background_color', ($crew->background_color ?? '#333333')) }}">
            <x-error name="background_color">Background color</x-error>
        </div>
        <div class="col-md">
            <div class="form-control form-control-color w-100">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" id="textColorModeSwitch" name="text_color_mode" value="light" {{ isChecked( old('text_color_mode', $crew->text_color_mode) == 'light' ) }}>
                    <label class="form-check-label text-capitalize w-100" for="textColorModeSwitch">
                      
                        <div class="px-2 rounded text-center" style="background-color:{{ $crew->background_color }}; color:{{ $crew->text_color }}">
                            <small class="{{ $crew->text_color_mode == 'dark' || is_null($crew->text_color_mode) ? 'd-block' : 'd-none' }}">
                                <b>DARK</b>
                            </small>
                            <small class="{{ $crew->text_color_mode == 'light' ? 'd-block' : 'd-none' }}">
                                <b>LIGHT</b>
                            </small>
                        </div>

                    </label>
                </div>
            </div>
            <x-error name="text_color_mode">Text color mode</x-error>
        </div>
    </div>
</x-form-control-horizontal>
<br>

@if( $crew->id <> null ) 
<div class="form-check form-switch">
    <input class="form-check-input" id="isActiveSwitch" type="checkbox" role="switch" name="is_active" value="1" {{ isChecked( old('is_active', $crew->is_active) == 1 ) }}>
    <label class="form-check-label" for="isActiveSwitch"><b>Active.</b> If it is deactivated, it cannot be used in new orders and the members of this crew will be removed.</label>
</div>
<x-error name="is_active" />
@endif
