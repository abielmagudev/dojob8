<x-form-field-horizontal label="Timeline" label-class="form-label-optional">
    <div class="mb-3">
        <div class="input-group">
            <span class="input-group-text" style="width:106px">Working</span>
            <input type="date" class="form-control {{ bsInputInvalid( $errors->has('working_date') ) }}" name="working_date" value="{{ $work_order->working_date_input }}">
            <input type="time" class="form-control {{ bsInputInvalid( $errors->has('working_time') ) }}" name="working_time" value="{{ $work_order->working_time_input }}">
        </div>
        <x-form-feedback error="working_date" />
        <x-form-feedback error="working_time" />
    </div>

    <div>
        <div class="input-group">
            <span class="input-group-text" style="width:106px">Done</span>
            <input type="date" class="form-control {{ bsInputInvalid( $errors->has('done_date') ) }}" name="done_date" value="{{ $work_order->done_date_input }}">
            <input type="time" class="form-control {{ bsInputInvalid( $errors->has('done_time') ) }}" name="done_time" value="{{ $work_order->done_time_input }}">
        </div>
        <x-form-feedback error="done_date" />
        <x-form-feedback error="done_time" />
    </div>

    @if( $work_order->hasCompletedAt() )      
    <div class="mt-3">
        <div class="input-group">
            <span class="input-group-text text-success">Completed</span>
            <div class="form-control">{{ $work_order->completed_date_human }}</div>
            <div class="form-control">{{ $work_order->completed_time_human }}</div>
        </div>
    </div>
    @endif
</x-form-field-horizontal>
