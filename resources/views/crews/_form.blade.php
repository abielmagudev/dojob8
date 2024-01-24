@csrf
<x-form-field-horizontal for="nameInput" label="Name">
    <input id="nameInput" type="text" class="form-control" name="name" value="{{ old('name', $crew->name) }}" required>
    <x-form-feedback error="name" />
</x-form-field-horizontal>

<x-form-field-horizontal for="backgroundColorInput" label="Color">
    <div class="position-relative mb-1">
        <div id="textColorModeFloating" class="position-absolute top-50 start-50 fw-bold text-uppercase" style="margin: -11px; color:{{ $crew->text_color }}">{{ $crew->text_color_mode ?? 'dark' }}</div>
        <input id="backgroundColorInput" type="color" class="form-control form-control-color w-100" style="height:56px" name="background_color" value="{{ old('background_color', ($crew->background_color ?? '#BBBBBB')) }}">
    </div>
    
    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" role="switch" id="textColorModeSwitch" name="text_color_mode" value="light" {{ isChecked( old('text_color_mode', $crew->text_color_mode) == 'light' ) }}>
        <label class="form-check-label small" for="textColorModeSwitch">Dark or light text color</label>
    </div>

    <x-form-feedback error="background_color" />
    <x-form-feedback error="text_color_mode" />
</x-form-field-horizontal>

<x-form-field-horizontal for="taskOptions" label="Tasks">
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

    <x-form-feedback error="tasks" />
    <x-form-feedback error="tasks.*" />
</x-form-field-horizontal>

<x-form-field-horizontal for="descriptionTextarea" label="Description" label-class="form-label-optional">
    <textarea id="descriptionTextarea" rows="3" class="form-control" name="description">{{ old('description', $crew->description) }}</textarea>
    <x-form-feedback error="description" />
</x-form-field-horizontal>
