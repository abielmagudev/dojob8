<div class="mb-3">
    <label for="filterStatusRuleSelect" class="form-label">Status</label>
    <ul id="statusGroupList" class="list-group rounded">
        @foreach(\App\Models\Inspection::allStatuses() as $status)
        <?php $checkbox_id = 'checkboxStatus' . ucfirst($status) ?>

        <li class="list-group-item list-group-item-action">
            <div class="form-check">
                <input id="{{ $checkbox_id }}" class="form-check-input" type="checkbox" name="status_group[]" value="{{ $status }}" {{ isChecked( in_array($status, $request->get('status_group', []), true) ) }}>
                <label for="{{ $checkbox_id }}" class="form-check-label text-uppercase w-100">{{ $status }}</label>
            </div>
        </li>
        @endforeach
    </ul>
</div>
