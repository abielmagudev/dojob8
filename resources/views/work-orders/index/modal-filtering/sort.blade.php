<div class="mb-3">
    <label for="modeSortSelect" class="form-label">Sort</label>
    <select id="modeSortSelect" class="form-select" name="sort">
        <option value="desc" {{ isSelected('desc' == $request->get('sort', 'desc')) }}>Newest to oldest</option>
        <option value="asc" {{ isSelected('asc' == $request->get('sort')) }}>Oldest to newest</option>
    </select>
</div>
