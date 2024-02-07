@csrf
<x-form-field-horizontal for="inputName" label="Name">
    <input id="inputName" type="text" class="form-control {{ bsInputInvalid( $errors->has('name') ) }}" name="name" value="{{ old('name', $job->name) }}" required>
    <x-form-feedback error="name" />
</x-form-field-horizontal>

<x-form-field-horizontal for="textareaDescription" label="Description" label-class="form-label-optional">
    <textarea id="textareaDescription" class="form-control {{ bsInputInvalid( $errors->has('description') ) }}" rows="3" name="description">{{ old('description', $job->description) }}</textarea>
    <x-form-feedback error="description" />
</x-form-field-horizontal>

<x-form-field-horizontal for="successfulInspectionsRequiredInput" label="Successful Inspections Required">
    <input id="successfulInspectionsRequiredInput" class="form-control {{ bsInputInvalid( $errors->has('successful_inspections_required') ) }}" type="number" min="0" max="10" name="successful_inspections_required" value="{{ old('successful_inspections_required', $job->successful_inspections_required ?? 0) }}" required>
    <x-form-feedback error="successful_inspections_required" />
</x-form-field-horizontal>

<x-form-field-horizontal label="Pre-configured required inspections" label-class="form-label-optional">    
    <div class="form-control {{ bsInputInvalid( $errors->has('preconfigured_required_inspections') ?? $errors->has('preconfigured_required_inspections.*') ) }} p-0">
        <x-table class="m-0">
            @foreach($agencies as $agency)
            <?php $checkbox_id = "agency{$agency->id}Checkbox" ?>
            <tr>
                <td style="width:1%" class="{{ $loop->last ? 'border-0' : '' }} bg-transparent">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="preconfigured_required_inspections[]" value="{{ $agency->id }}" id="{{ $checkbox_id }}" {{ isChecked( in_array($agency->id, $job->preconfigured_required_inspections_array) ) }}>
                    </div>
                </td>
                <td class="{{ $loop->last ? 'border-0' : '' }} bg-transparent ">
                    <label class="form-check-label" for="{{ $checkbox_id }}">
                        {{ $agency->name }}
                    </label>
                </td>
            </tr>
            @endforeach
        </x-table>
    </div>
    <x-form-feedback error="preconfigured_required_inspections" />
    <x-form-feedback error="preconfigured_required_inspections.*" />
</x-form-field-horizontal>
