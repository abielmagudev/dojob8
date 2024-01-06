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
        <label for="typeTaskOptions" class="form-label">Tasks</label>
    </x-slot>

    <div class="form-control p-0">
        <table class="table table-hover m-0">
            @foreach($all_tasks as $task)
            <?php $checkbox_id = "task" . ucwords( str_replace([' ', '-'], '', $task) ) ?>
            <tr>
                <td class="{{ $loop->last ? 'border-0' : '' }} bg-transparent">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="tasks[]" value="{{ $task }}" id="{{ $checkbox_id }}" {{ isChecked( $crew->hasTask($task) ) }}>
                        <label class="form-check-label text-capitalize" for="{{ $checkbox_id }}">{{ $task }}</label>
                    </div>
                </td>
            </tr>
            @endforeach
        </table>
    </div>

    <x-error name="tasks" />
    <x-error name="tasks.*" />
</x-form-control-horizontal>

<x-form-control-horizontal>
    <x-slot name="label">
        <label class="form-label">Color</label>
    </x-slot>

    <div class="position-relative mb-1">
        <div id="textColorModeFloating" class="position-absolute top-50 start-50 fw-bold text-uppercase" style="margin: -11px; color:{{ $crew->text_color }}">{{ $crew->text_color_mode ?? 'dark' }}</div>
        <input id="backgroundColorInput" type="color" class="form-control form-control-color w-100" style="height:64px" name="background_color" value="{{ old('background_color', ($crew->background_color ?? '#BBBBBB')) }}">
    </div>
    
    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" role="switch" id="textColorModeSwitch" name="text_color_mode" value="light" {{ isChecked( old('text_color_mode', $crew->text_color_mode) == 'light' ) }}>
        <label class="form-check-label small" for="textColorModeSwitch">Dark or light text color</label>
    </div>

    <x-error name="background_color" />
    <x-error name="text_color_mode" />
</x-form-control-horizontal>

<x-form-control-horizontal>
    <x-slot name="label">
        <label for="descriptionTextarea" class="form-label form-label-optional">Description</label>
    </x-slot>
    <textarea id="descriptionTextarea" rows="3" class="form-control" name="description">{{ old('description', $crew->description) }}</textarea>
    <x-error name="description" />
</x-form-control-horizontal>
<br>

@if( $crew->id <> null ) 
<div class="form-check form-switch">
    <input class="form-check-input" id="isActiveSwitch" type="checkbox" role="switch" name="is_active" value="1" {{ isChecked( old('is_active', $crew->is_active) == 1 ) }}>
    <label class="form-check-label" for="isActiveSwitch"><b>Active.</b> If it is deactivated, it cannot be used in new orders and the members of this crew will be removed.</label>
</div>
<x-error name="is_active" />
@endif
