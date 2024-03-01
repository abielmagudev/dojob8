<x-form-field-horizontal for="inputScheduleDate" label="Schedule" label-class="{{ !$work_order->hasScheduledDate() ? 'form-label-pending' : '' }}">
    <input type="date" class="form-control {{ bsInputInvalid( $errors->has('scheduled_date') ) }}" id="inputScheduleDate" name="scheduled_date" value="{{ old('scheduled_date', $work_order->scheduled_date_input) }}" {{ isAutofocused( $errors->isEmpty() ) }}>
    <x-form-feedback error="scheduled_date"></x-error>
</x-form-field-horizontal>
