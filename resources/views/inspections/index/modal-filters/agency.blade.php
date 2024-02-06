<div class="mb-3">
    <label for="agenciesSelect" class="form-label">Agency</label>
    <select id="agenciesSelect" class="form-select" name="agency">
        <option label="Any agency" selected></option>
        
        @foreach($agencies as $agency)
        <option value="{{ $agency->id }}" {{ isSelected($agency->id == $request->get('agency')) }}>{{ $agency->name }}</option>
        @endforeach
    </select>
</div>
