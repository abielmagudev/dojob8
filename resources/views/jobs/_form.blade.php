<x-form-field-horizontal for="inputName" label="Name">
    <input id="inputName" type="text" class="form-control {{ bsInputInvalid( $errors->has('name') ) }}" name="name" value="{{ old('name', $job->name) }}" autofocus required>
    <x-form-feedback error="name" />
</x-form-field-horizontal>

<x-form-field-horizontal for="textareaDescription" label="Description" label-class="form-label-optional">
    <textarea id="textareaDescription" class="form-control {{ bsInputInvalid( $errors->has('description') ) }}" rows="3" name="description">{{ old('description', $job->description) }}</textarea>
    <x-form-feedback error="description" />
</x-form-field-horizontal>

<x-form-field-horizontal for="successInspectionsRequiredCountInput" label="Success inspections required">
    <input id="successInspectionsRequiredCountInput" class="form-control {{ bsInputInvalid( $errors->has('success_inspections_required_count') ) }}" type="number" min="0" max="10" name="success_inspections_required_count" value="{{ old('success_inspections_required_count', $job->success_inspections_required_count ?? 0) }}" required>
    <x-form-feedback error="success_inspections_required_count" />
</x-form-field-horizontal>

<x-form-field-horizontal label="Configure to create inspections after creating a work order with this job." label-class="form-label-optional">    
    <div class="list-group list-group-flush rounded border {{ $errors->has('agencies') || $errors->has('agencies.*') ? 'border-danger' : '' }}">
        @foreach($agencies as $agency)
        <?php $checked = (bool) $job->inspection_setup->filter(function($setup) use ($agency) {
            return $setup->hasAgency($agency);
        })->count() ?>

        <?php $checkbox_id = "agency{$agency->id}Checkbox" ?>
        <div class="list-group-item list-group-item-action">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="{{ $checkbox_id }}" name="inpsections_setup[][agency]" value="{{ $agency->id }}" {{ isChecked( $checked ) }}>
                <label class="form-check-label" for="{{ $checkbox_id }}">{{ $agency->name }}</label>
            </div>
        </div>
        @endforeach
    </div>
    <x-form-feedback error="agencies" />
    <x-form-feedback error="agencies.*" />
</x-form-field-horizontal>
