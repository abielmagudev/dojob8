<div class="mb-3">
    <label for="sortPropSelect" class="form-label">Sort by</label>
    <select id="sortPropSelect" name="sort_prop" class="form-select mb-2">
        <option label="Any option" selected></option>
        <option value="name" {{ isSelected( $request->get('sort_prop') == 'name' ) }}>Name</option>
        <option value="last_name" {{ isSelected( $request->get('sort_prop') == 'last_name' ) }}>Last name</option>
    </select>
    <select id="sortPropWaySelect" name="sort_prop_way" class="form-select">
        <option value="asc" {{ isSelected( $request->get('sort_prop_way') == 'asc' ) }}>Descending</option>
        <option value="desc" {{ isSelected( $request->get('sort_prop_way') == 'desc' ) }}>Ascending</option>
    </select>
</div>
