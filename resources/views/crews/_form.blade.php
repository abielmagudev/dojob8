@csrf
<div class="mb-3">
    <label for="nameInput" class="form-label">Name</label>
    <input id="nameInput" type="text" class="form-control" name="name" value="{{ old('name', $crew->name) }}" required>
    <x-form-feedback error="name" />
</div>

<div class="mb-3">
    <label for="backgroundColorInput" class="form-label">Color</label>
    <div class="row g-3">
        {{-- Background color --}}
        <div class="col-sm">
            <div class="input-group flex-nowrap">
                <label class="input-group-text text-secondary" for="backgroundColorInput">
                    <small>Background</small>
                </label>
                <input id="backgroundColorInput" type="color" class="form-control form-control-color w-100" name="background_color" value="{{ old('background_color', $crew->background_color) }}">
            </div>
            <x-form-feedback error="background_color" />
        </div>

        {{-- Text color --}}
        <div class="col-sm">
            <div class="input-group flex-nowrap">
                <label class="input-group-text text-secondary" for="textColorInput" style="width:157px">
                    <small>Text</small>
                </label>
                <input id="textColorInput" type="color" class="form-control form-control-color w-100" name="text_color" value="{{ old('text_color', $crew->text_color) }}">
            </div>
            <x-form-feedback error="text_color" />
        </div>

        {{-- Sample --}}
        <div class="col-sm">
            <div class="form-control form-control-color w-100">
                <div id="coloredExample" class="rounded text-center fw-bold small" style="padding:0.1rem 0;background-color:{{ old('background_color', $crew->background_color) }};color:{{ old('text_color', $crew->text_color) }}">{{ $crew->name ?? 'Sample' }}</div>
            </div>
        </div>
    </div>
</div>

<div class="mb-3">
    <label class="form-label">Tasks</label>
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
</div>

<div class="mb-3">
    <label for="descriptionTextarea" class="form-label form-label-optional">Description</label>
    <textarea id="descriptionTextarea" rows="3" class="form-control" name="description">{{ old('description', $crew->description) }}</textarea>
    <x-form-feedback error="description" />
</div>

@push('scripts')
<script>
const coloredExample = {
    element: document.getElementById('coloredExample'),
    listen: function () {
        document.getElementById('backgroundColorInput').addEventListener('input', function (evt) {
            coloredExample.element.style.backgroundColor = this.value
        });

        document.getElementById('textColorInput').addEventListener('input', function (etv) {
            coloredExample.element.style.color = this.value
        });
    },
}
coloredExample.listen()
</script>
@endpush
