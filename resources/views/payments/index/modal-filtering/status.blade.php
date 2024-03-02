<div class="mb-3">
    <label class="form-label">Status</label>
    <div class="form-control p-0">
        <ul class="list-group list-group-flush rounded">
            @foreach($all_statuses as $value)   
            <?php $checkbox_id = sprintf('payment%sStatusCheckbox', ucfirst($value))  ?>                  
            <li class="list-group-item list-group-item-action">
                <div class="form-check text-uppercase">
                    <input id="{{ $checkbox_id }}" class="form-check-input" type="checkbox" name="status_group[]" value="{{ $value }}" {{ isChecked( is_array($request->get('status_group')) && in_array($value, $request->get('status_group', [])) ) }}>
                    <label for="{{ $checkbox_id }}" class="form-check-label">{{ $value }}</label>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
</div>
