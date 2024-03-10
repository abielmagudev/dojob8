<div class="mb-3">
    <label for="statusSelect" class="form-label">Status</label>
    <select id="statusSelect" name="status" class="form-select">
        <option label="* Any status" selected></option>
        <option value="1" {{ isSelected( $request->get('status') === "1" ) }}>Active</option>
        <option value="0" {{ isSelected( $request->get('status') === "0" ) }}>Inactive</option>
    </select>
</div>
