<div class="mb-3">
    <label for="filterStatusSelect" class="form-label">Status</label>
    <div class="border rounded">
        <div class="list-group list-group-flush rounded">
            @foreach($all_statuses as $status)
            <?php $checkbox_id = 'checkboxStatus' . ucfirst($status) ?>
            <div class="list-group-item list-group-item-action">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="status_group[]" value="{{ $status }}" id="{{ $checkbox_id }}" {{ isChecked( in_array($status, $request->get('status_group', [])) ) }}>
                    <label class="form-check-label text-capitalize w-100" for="{{ $checkbox_id }}">{{ $status }}</label>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
