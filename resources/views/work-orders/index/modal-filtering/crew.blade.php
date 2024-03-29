{{-- Crews --}}
@isset( $filtering['crews'] )
<div class="mb-3">
    <label for="filterCrewSelect" class="form-label">Crew</label>
    <select id="filterCrewSelect" class="form-select" name="crew">
        <option label="Any crew" selected></option>

        @foreach($filtering['crews'] as $crew)
        <option value="{{ $crew->id }}" {{ isSelected($crew->id == $request->get('crew')) }}>{{ $crew->name }}</option>
        @endforeach

    </select>
</div>
@endif
