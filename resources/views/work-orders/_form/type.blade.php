<x-form-field-horizontal for="typeSelect" label="Type">
    <?php $old_type = old('type', ($work_order->type ?? 'standard')) ?>

    <select id="typeSelect" class="form-select {{ bsInputInvalid( $errors->has('type') ) }}" name="type" required>
        @foreach($all_types as $type)
        <option value="{{ $type }}" {{ isSelected( $type == $old_type ) }}>
            {{ title($type) }}
        </option>
        @endforeach
    </select>
    <x-form-feedback error="type" />

    <div class="{{ $old_type == 'standard' ? 'd-none' : '' }} mt-3">
        <select name="type_id" id="typeIdSelect" class="form-select {{ bsInputInvalid( $errors->has('type_id') ) }}" {{ $old_type == 'standard' ? 'disabled' : '' }} required>
            @foreach($work_orders_for_rectification as $wo)
            <option value="{{ $wo->id }}">#{{ $wo->id }} - {{ $wo->job->name }}</option>
            @endforeach
        </select>
        <x-form-feedback error="type_id" important>Only standard work orders with completed status from the current client will be displayed.</x-form-feedback>
    </div>
</x-form-field-horizontal>

@push('scripts')
<script>
const typeSelect = {
    element: document.getElementById('typeSelect'),
    listen: function () {
        this.element.addEventListener('change', function () {
            typeIdSelect.toggle(this.value);
        })      
    }
}

const typeIdSelect = {
    element: document.getElementById('typeIdSelect'),
    toggle: function (value) {
        this.element.closest('div').classList.toggle('d-none', value == 'standard');
        this.element.disabled = value == 'standard';
    }
}

typeSelect.listen()
</script>
@endpush
