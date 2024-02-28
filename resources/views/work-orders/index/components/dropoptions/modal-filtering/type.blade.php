{{-- Type --}}
<div class="mb-3">
    <label for="filterTypeSelect" class="form-label">Type</label>
    <div class="border rounded overflow-hidden">
        <div class="list-group list-group-flush">
            @foreach(\App\Models\WorkOrder::getAllTypes() as $type)
            <?php $checkbox_id = 'checkboxType' . ucfirst($type) ?>
            <div class="list-group-item list-group-item-action">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="type_group[]" value="{{ $type }}" id="{{ $checkbox_id }}" {{ isChecked( in_array($type, $request->get('type_group', [])) ) }}>
                    <label class="form-check-label text-capitalize w-100" for="{{ $checkbox_id }}">{{ $type }}</label>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
