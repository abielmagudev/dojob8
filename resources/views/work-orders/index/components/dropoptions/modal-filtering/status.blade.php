<div class="mb-3">
    <label for="filterStatusSelect" class="form-label">Status</label>
    <div class="border rounded overflow-hidden">
        <div class="list-group list-group-flush overflow-y-scroll" style="height:148px">
            @foreach(\App\Models\WorkOrder::getAllStatuses() as $status)
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
    <small class="text-secondary">Scroll up or down to see all statuses.</small>
</div>
