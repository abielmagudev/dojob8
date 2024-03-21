<div class="mb-3">
    <label for="isWalkThruSelect" class="form-label">Type</label>
    <select id="isWalkThruSelect" class="form-select" name="type">
        <option value="0" {{ isSelected( request('type') == 0 ) }}>Regular</option>
        <option value="1" {{ isSelected( request('type') == 1 ) }}>Walk Thru</option>
    </select>
</div>
