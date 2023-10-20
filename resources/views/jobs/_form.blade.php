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
    <label for="inputSuccessfulInspections" class="form-label">Successful inspections</label>
    <input type="number" step="1" min="0" class="form-control" id="inputSuccessfulInspections" name="successful_inspections" value="{{ old('successful_inspections', ($job->successful_inspections ?? 0)) }}" required>
    <x-error name="successful_inspections" />
</div>
