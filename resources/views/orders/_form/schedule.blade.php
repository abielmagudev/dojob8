<div class="row mb-3">
    <div class="col-md">
        <label for="inputScheduleDate" class="form-label">Schedule</label>
    </div>
    <div class="col-md col-md-9 col-lg-10">
        <div class="row">
            <div class="col-sm">
                <input type="date" class="form-control {{ bsInputInvalid( $errors->has('scheduled_date') ) }}" id="inputScheduleDate" name="scheduled_date" value="{{ old('scheduled_date', $order->scheduled_date) }}" required>
                <x-error name="scheduled_date"></x-error>
            </div>
            <div class="col-sm">
                <input type="time" class="form-control {{ bsInputInvalid( $errors->has('scheduled_time') ) }}" id="inputScheduleTime" name="scheduled_time" value="{{ old('scheduled_time', $order->scheduled_time_without_miliseconds) }}" required>
                <x-error name="scheduled_time"></x-error>
            </div>
        </div>
    </div>
</div>
