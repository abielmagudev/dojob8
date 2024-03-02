<div class="mb-3">
    <label for="crewSelect" class="form-label">Crew</label>
    <select id="crewSelect" class="form-select" name="crew">
        <option label="Any crew" selected></option>
        
        @foreach(\App\Models\Crew::taskInspections()->active()->get() as $crew)
        <option value="{{ $crew->id }}" {{ isSelected($crew->id == $request->get('crew')) }}>{{ $crew->name }}</option>
        @endforeach
    </select>
</div>
