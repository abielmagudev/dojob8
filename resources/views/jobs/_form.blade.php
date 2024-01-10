@csrf
<x-form-field-horizontal for="inputName" label="Name">
    <input type="text" class="form-control" id="inputName" name="name" value="{{ old('name', $job->name) }}" required>
    <x-error name="name" />
</x-form-field-horizontal>

<x-form-field-horizontal for="textareaDescription" label="Description" label-class="form-label-optional">
    <textarea id="textareaDescription" rows="3" class="form-control" name="description">{{ old('description', $job->description) }}</textarea>
    <x-error name="description" />
</x-form-field-horizontal>

<x-form-field-horizontal label="Pre-configured required inspections" label-class="form-label-optional">    
    <div class="form-control p-0">
        <x-table class="m-0">
            @foreach($inspectors as $inspector)
            <?php $checkbox_id = "inspector{$inspector->id}Checkbox" ?>
            <tr>
                <td style="width:1%" class="{{ $loop->last ? 'border-0' : '' }} bg-transparent">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="preconfigured_required_inspections[]" value="{{ $inspector->id }}" id="{{ $checkbox_id }}" {{ isChecked( in_array($inspector->id, $job->preconfigured_required_inspections_array) ) }}>
                    </div>
                </td>
                <td class="{{ $loop->last ? 'border-0' : '' }} bg-transparent ">
                    <label class="form-check-label" for="{{ $checkbox_id }}">
                        {{ $inspector->name }}
                    </label>
                </td>
            </tr>
            @endforeach
        </x-table>
    </div>
    <x-error name="preconfigured_required_inspections" />
    <x-error name="preconfigured_required_inspections.*" />
</x-form-field-horizontal>

@if( $job->id )
<div class="mt-4">
    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" role="switch" id="availableSwitch" name="available" value="1" {{ isChecked( $job->isAvailable() ) }}>
        <label class="form-check-label" for="availableSwitch">
            <b>Available.</b>
            <small>If you deactivate this option, you will not be able to use this job in new orders.</small>
        </label>
    </div> 
</div>
@endif
