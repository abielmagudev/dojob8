<div class="mb-3">
    <label for="filterContractorSelect" class="form-label">Contractor</label>
    <select id="filterContractorSelect" class="form-select" name="contractor">
        <option label="Any contractor *" selected></option>
        <option value="0" {{ isSelected( request('contractor') === '0' ) }}>Not contractor</option>

        @foreach($collection as $contractor)
        {{ $contractor }}
        <option value="{{ $contractor->id }}" {{ isSelected($contractor->id == request('contractor')) }}>{{ $contractor->name }} ({{ $contractor->alias }})</option>
        @endforeach
    </select>
</div>
