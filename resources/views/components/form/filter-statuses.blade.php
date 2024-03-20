<div class="mb-3">
    <label for="filterStatusSelect" class="form-label">Status</label>
    <div class="border rounded">
        <div class="list-group list-group-flush rounded">

            @foreach($collection as $status)
            <?php $checkbox_id = sprintf('%sStatusCheckbox', $status) ?>
            <div class="list-group-item list-group-item-action">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="status_group[]" value="{{ $status }}" id="{{ $checkbox_id }}" {{ isChecked( in_array($status, request('status_group', [])) ) }}>
                    <label class="form-check-label text-capitalize w-100" for="{{ $checkbox_id }}">{{ $status }}</label>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</div>
