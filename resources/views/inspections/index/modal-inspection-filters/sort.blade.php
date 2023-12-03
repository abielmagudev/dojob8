<div class="mb-3">
    <label for="sortSelect" class="form-label">Sort</label>
    <select  id="sortSelect" class="form-select" name="sort">
        <option value="desc" {{ isSelected( $request->get('sort', 'desc') == 'desc' ) }}>Newest to oldest</option>
        <option value="asc" {{ isSelected( $request->get('sort') == 'asc' ) }}>Oldest to newest</option>
    </select>
</div>
