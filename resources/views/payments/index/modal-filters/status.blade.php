<div class="mb-3">
    <label class="form-label">Status</label>
    <div class="form-control">
        <ul class="list-group list-group-flush">
            @foreach($payment_statuses as $value)   
            <?php $checkbox_id = sprintf('payment%sStatusCheckbox', ucfirst($value))  ?>                  
            <li class="list-group-item list-group-item-action">
                <div class="form-check text-uppercase">
                    <input id="{{ $checkbox_id }}" class="form-check-input" type="checkbox" name="payment_status_group[]" value="{{ $value }}" {{ isChecked( in_array($value, $request->get('payment_status_group', [])) ) }}>
                    <label for="{{ $checkbox_id }}" class="form-check-label">{{ $value }}</label>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
</div>
