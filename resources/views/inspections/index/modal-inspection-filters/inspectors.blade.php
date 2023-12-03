<div class="mb-3">
    <label for="" class="form-label">Inpector</label>
    <select id="" class="form-select" name="inspector">
        <option label="Any inspector" selected></option>
        
        @foreach($inspectors as $inspector)
        <option value="{{ $inspector->id }}" {{ isSelected($inspector->id == $request->get('inspector')) }}>{{ $inspector->name }}</option>
        @endforeach
    </select>
</div>
