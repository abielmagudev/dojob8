<x-form-field-horizontal for="statusSelect" label="Status">
    <select id="statusSelect" class="form-select text-capitalize {{ bsInputInvalid( $errors->has('status') ) }}" name="status">
        @foreach($all_form_statuses as $status)
        <option value="{{ $status }}" {{ isSelected($status == $work_order->status) }}>{{ $status }}</option>
        @endforeach
        
        @if( $work_order->qualifiesForPendingStatus() )
        <option value="pending" selected>Pending</option>
        @endif
    </select>
    @if( $work_order->qualifiesForPendingStatus() )
    <div class="alert alert-warning mt-3">If any information is missing, such as the schedule date, it will automatically be a <b>pending status</b>.</div>
    @endif
</x-form-field-horizontal>
