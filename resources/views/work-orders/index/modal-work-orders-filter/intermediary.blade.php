{{-- Crews --}}
<div class="mb-3">
    <label for="filterIntermediarySelect" class="form-label">Intermediary</label>
    <select id="filterIntermediarySelect" class="form-select" name="intermediary">
        <option label="Any intermediary" selected></option>

        @foreach($intermediaries->sortBy('name') as $intermediary)
        <option value="{{ $intermediary->id }}" {{ isSelected($intermediary->id == $request->get('intermediary')) }}>{{ $intermediary->name }} ({{ $intermediary->alias }})</option>
        @endforeach

    </select>
</div>
