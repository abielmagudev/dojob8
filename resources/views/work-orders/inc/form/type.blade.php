<x-form-field-horizontal for="typeSelect" label="Type">
    <?php $old_type = old('type', ($work_order->type ?? $catalog_types->default())) ?>

    <select id="typeSelect" class="form-select {{ bsInputInvalid( $errors->has('type') ) }}" name="type" required>
        <?php $types = $client->work_orders_to_rectify->count() ? $catalog_types->all() : $catalog_types->standard() ?>

        @foreach($types as $type)
        <option value="{{ $type }}" {{ isSelected( $type == $old_type ) }}>
            {{ title($type) }}
        </option>
        @endforeach
    </select>
    <x-form-feedback error="type" />

    @if( $client->work_orders_to_rectify->count() ) 
    <div class="{{ $old_type == $catalog_types->default() ? 'd-none' : '' }} mt-3">
        <select id="rectificationIdSelect" class="form-select {{ bsInputInvalid( $errors->has('rectification_id') ) }}" name="rectification_id" {{ $old_type == $catalog_types->default() ? 'disabled' : '' }} required>
            @foreach($client->work_orders_to_rectify as $wo)
            <option value="{{ $wo->id }}">#{{ $wo->id }} - {{ $wo->job->name }}</option>
            @endforeach
        </select>
        <x-form-feedback error="rectification_id" important>Only standard work orders with completed status from the current client will be displayed.</x-form-feedback>
    </div>
    @endif
</x-form-field-horizontal>

@if( $client->work_orders_to_rectify->count() ) 
@push('scripts')
<script>
const rectificationIdSelect = {
    element: document.getElementById('rectificationIdSelect'),
    trigger: document.getElementById('typeSelect'),
    value_to_hide: "<?= $catalog_types->default() ?>",
    listen: function () {
        let self = this

        this.trigger.addEventListener('change', function (evt) {
            let switcher = this.value == self.value_to_hide;
            self.element.closest('div').classList.toggle('d-none', switcher)
            self.element.disabled = switcher
        })
    }
}
rectificationIdSelect.listen()
</script>
@endpush
@endif
