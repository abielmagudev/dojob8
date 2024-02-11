<x-form-field-horizontal for="nameInput" label="Name">
    <input id="nameInput" type="text" class="form-control" name="name" value="{{ old('name', $crew->name) }}" autofocus required>
    <x-form-feedback error="name" />
</x-form-field-horizontal>

<x-form-field-horizontal label="Color">
    <div class="form-control form-control-color w-100 mb-3">
        <div id="colorSample" class="rounded text-center fw-bold small" style="padding:0.1rem 0;background-color:{{ old('background_color', $crew->background_color) }};color:{{ old('text_color', $crew->text_color) }}">{{ $crew->name ?? 'Sample' }}</div>
    </div>
    <div class="row g-3">
        <div class="col-sm">
            <input id="backgroundColorInput" type="color" class="form-control form-control-color w-100" name="background_color" value="{{ old('background_color', $crew->background_color) }}">
            <x-form-feedback error="background_color">Background</x-form-feedback>
        </div>
        <div class="col-sm">
            <input id="textColorInput" type="color" class="form-control form-control-color w-100" name="text_color" value="{{ old('text_color', $crew->text_color) }}">
            <x-form-feedback error="text_color">Text</x-form-feedback>
        </div>
    </div>
</x-form-field-horizontal>

<x-form-field-horizontal label="Tasks">
    <div class="form-control">
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

<x-form-field-horizontal for="" label="Description" label-class="form-label-optional">
    <textarea id="descriptionTextarea" rows="3" class="form-control" name="description">{{ old('description', $crew->description) }}</textarea>
    <x-form-feedback error="description" />
</x-form-field-horizontal>

@push('scripts')
<script>
const colorSample = {
    element: document.getElementById('colorSample'),
    listen: function () {
        document.getElementById('backgroundColorInput').addEventListener('input', function (evt) {
            colorSample.element.style.backgroundColor = this.value
        });

        document.getElementById('textColorInput').addEventListener('input', function (etv) {
            colorSample.element.style.color = this.value
        });
    },
}
colorSample.listen()
</script>
@endpush
