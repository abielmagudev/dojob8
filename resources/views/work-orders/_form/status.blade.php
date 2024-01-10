<x-form-field-horizontal for="statusSelect" label="Status">
    <select id="statusSelect" class="form-select text-capitalize" name="status">
        @foreach($all_statuses as $status)
        <option value="{{ $status }}" {{ isSelected($status == $work_order->status) }}>{{ $status }}</option>
        @endforeach
    </select>
</x-form-field-horizontal>
