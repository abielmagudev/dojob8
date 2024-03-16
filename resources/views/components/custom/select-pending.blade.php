{{-- Pending attributes --}}
<div class="mb-3">
    <label for="filterPendingSelect" class="form-label">Pending</label>
    <select id="filterPendingSelect" class="form-select" name="pending">
        <option label="Any" {{ isSelected( !request()->filled('pending') ) }}></option>
        <option value="0" {{ isSelected( request()->get('pending') == '0' ) }}>No, without pending</option>
        <option value="1" {{ isSelected( request()->get('pending') == '1') }}>Yes, with pending</option>
    </select>
</div>
