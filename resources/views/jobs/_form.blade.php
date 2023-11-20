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
