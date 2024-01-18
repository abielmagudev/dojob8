<x-form-field-horizontal for="inputScheduleDate" label="Schedule">
    <input type="date" class="form-control {{ bsInputInvalid( $errors->has('scheduled_date') ) }}" id="inputScheduleDate" name="scheduled_date" value="{{ old('scheduled_date', $work_order->scheduled_date_input) }}" required>
    <x-form-feedback error="scheduled_date"></x-error>
</x-form-field-horizontal>
