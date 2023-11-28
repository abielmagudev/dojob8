<x-form-control-horizontal class="align-items-center">
    <x-slot name="label">
        <label for="inputScheduleDate" class="form-label">Schedule</label>
    </x-slot>

    <div class="row">
        <div class="col-sm">
            <input type="date" class="form-control {{ bsInputInvalid( $errors->has('scheduled_date') ) }}" id="inputScheduleDate" name="scheduled_date" value="{{ old('scheduled_date', $work_order->scheduled_date_input) }}" required>
            <x-error name="scheduled_date"></x-error>
        </div>
        <div class="col-sm">
            <input type="time" class="form-control {{ bsInputInvalid( $errors->has('scheduled_time') ) }}" id="inputScheduleTime" name="scheduled_time" value="{{ old('scheduled_time', $work_order->scheduled_time_without_miliseconds) }}" required>
            <x-error name="scheduled_time"></x-error>
        </div>
    </div>
</x-form-control-horizontal>
