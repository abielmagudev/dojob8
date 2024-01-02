<x-form-control-horizontal class="align-items-center">
    <x-slot name="label">
        <label for="inputScheduleDate" class="form-label">Schedule</label>
    </x-slot>

    <div>
        <input type="date" class="form-control {{ bsInputInvalid( $errors->has('scheduled_date') ) }}" id="inputScheduleDate" name="scheduled_date" value="{{ old('scheduled_date', $work_order->scheduled_date_input) }}" required>
        <x-error name="scheduled_date"></x-error>
    </div>
</x-form-control-horizontal>
