<x-form-control-horizontal class="align-items-center">
    <x-slot name="label">
        <label for="statusSelect" class="form-label">Status</label>
    </x-slot>

    <select id="statusSelect" class="form-select text-capitalize" name="status">
        <option disabled selected label="Without status..."></option>
        @foreach($all_statuses as $status)
        <option value="{{ $status }}" {{ isSelected($status == $work_order->status) }}>{{ $status }}</option>
        @endforeach
    </select>
</x-form-control-horizontal>
