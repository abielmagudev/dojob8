<x-form-field-horizontal for="inputName" label="Name">
    <input id="inputName" type="text" class="form-control {{ bsInputInvalid( $errors->has('name') ) }}" name="name" value="{{ old('name', $job->name) }}" autofocus required>
    <x-form-feedback error="name" />
</x-form-field-horizontal>

<x-form-field-horizontal for="textareaDescription" label="Description" label-class="form-label-optional">
    <textarea id="textareaDescription" class="form-control {{ bsInputInvalid( $errors->has('description') ) }}" rows="3" name="description">{{ old('description', $job->description) }}</textarea>
    <x-form-feedback error="description" />
</x-form-field-horizontal>

<x-form-field-horizontal for="approvedInspectionsRequiredCountInput" label="Approved inspections required">
    <input id="approvedInspectionsRequiredCountInput" class="form-control {{ bsInputInvalid( $errors->has('approved_inspections_required_count') ) }}" type="number" min="0" max="10" name="approved_inspections_required_count" value="{{ old('approved_inspections_required_count', $job->approved_inspections_required_count ?? 0) }}" required>
    <x-form-feedback error="approved_inspections_required_count" />
</x-form-field-horizontal>

<x-form-field-horizontal label="Choose the agencies to autogenerate inspections after a work order with this job has been created" label-class="form-label-optional">    
    <div class="list-group list-group-flush rounded border {{ $errors->has('agencies_generate_inspections') || $errors->has('agencies_generate_inspections.*') ? 'border-danger' : '' }}">
        @foreach($agencies as $agency)
        <?php $checkbox_id = "agency{$agency->id}Checkbox" ?>
        <div class="list-group-item list-group-item-action">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="agencies_generate_inspections[]" value="{{ $agency->id }}" id="{{ $checkbox_id }}" {{ isChecked( $job->hasAgencyToGenerateInspections($agency->id) ) }}>
                <label class="form-check-label" for="{{ $checkbox_id }}">{{ $agency->name }}</label>
            </div>
        </div>
        @endforeach
    </div>
    <x-form-feedback error="agencies_generate_inspections" />
    <x-form-feedback error="agencies_generate_inspections.*" />
</x-form-field-horizontal>
