<div class="mb-3">
    <label for="sortSelect" class="form-label">Sort</label>
    <select id="sortSelect" class="form-select" name="sort">
        <option value="desc" {{ isSelected('desc' == request()->get('sort', 'desc')) }}>Newest to oldest</option>
        <option value="asc" {{ isSelected('asc' == request()->get('sort')) }}>Oldest to newest</option>
    </select>
</div>
