@csrf
<div class="mb-3">
    <label for="inputName" class="form-label">Name</label>
    <input type="text" class="form-control" id="inputName" name="name" value="{{ old('name', $job->name) }}" required>
    <x-error name="name" />
</div>
<div class="mb-3">
    <label for="textareaDescription" class="form-label">Description <small class="text-body-secondary">(Optional)</small></label>
    <textarea id="textareaDescription" rows="3" class="form-control" name="description">{{ old('description', $job->description) }}</textarea>
    <x-error name="description" />
</div>
<div class="mb-3">
    <label for="inputApprovedInspectionsRequired" class="form-label">Approved inspections required</label>
    <input type="number" step="1" min="0" class="form-control" id="inputApprovedInspectionsRequired" name="approved_inspections_required" value="{{ old('approved_inspections_required', ($job->approved_inspections_required ?? 0)) }}" required>
    <x-error name="approved_inspections_required" />
</div>
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