<x-form-field-horizontal for="permitCodeInput" label="Permit code" label-class="form-label-optional">
    <input id="permitCodeInput" type="text" class="form-control {{ bsInputInvalid( $errors->has('permit_code') ) }}" name="permit_code" value="{{ old('permit_code', $work_order->permit_code) }}">
    <x-form-feedback error="permit_code" />
</x-form-field-horizontal>
