@csrf
<x-form-control-horizontal class="align-items-center">
    <x-slot name="label">
        <label for="inputName" class="form-label">Name</label>
    </x-slot>
    
    <input type="text" class="form-control" id="inputName" name="name" value="{{ old('name', $job->name) }}" required>
    <x-error name="name" />
</x-form-control-horizontal>

<x-form-control-horizontal class="">
    <x-slot name="label">
        <label for="textareaDescription" class="form-label form-label-optional">Description</label>
    </x-slot>
    
    <textarea id="textareaDescription" rows="3" class="form-control" name="description">{{ old('description', $job->description) }}</textarea>
    <x-error name="description" />
</x-form-control-horizontal>

<x-form-control-horizontal class="align-items-center">
    <x-slot name="label">
        <label for="inputApprovedInspectionsRequired" class="form-label">Approved inspections</label>
    </x-slot>
    
    <input type="number" step="1" min="0" class="form-control" id="inputApprovedInspectionsRequired" name="approved_inspections_required" value="{{ old('approved_inspections_required', ($job->approved_inspections_required ?? 0)) }}" required>
    <x-error name="approved_inspections_required" />
</x-form-control-horizontal>


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
