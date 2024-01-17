<div class="mb-3">
    <label for="inspectorSelect" class="form-label">Inpector</label>
    <select id="inspectorSelect" class="form-select" name="inspector">
        <option label="Any inspector" selected></option>
        
        @foreach(\App\Models\Inspector::all() as $inspector)
        <option value="{{ $inspector->id }}" {{ isSelected($inspector->id == $request->get('inspector')) }}>{{ $inspector->name }}</option>
        @endforeach
    </select>
</div>
