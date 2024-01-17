{{-- Status --}}
<div class="mb-3">
    <label for="filterStatusSelect" class="form-label">Status</label>
    <select id="filterStatusSelect" class="form-select text-capitalize" name="status">
        <option label="Any status" selected></option>

        @foreach($work_orders_status as $status)
        <option value="{{ $status }}" {{ isSelected($status == $request->get('status')) }}>{{ $status }}</option>
        @endforeach

    </select>
</div>
