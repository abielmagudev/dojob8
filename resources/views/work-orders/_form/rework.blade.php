<x-form-field-horizontal for="reworkTypeSelect" label="Rework" label-class="form-label-optional">

    <div class="mb-3">
        <select id="reworkTypeSelect" class="form-select" name="rework_type">
            <option value="0" selected>No, it's not a rework</option>
            <option value="1">Yes, it's a rework</option>
        </select>
    </div>

    <div>
        <select id="reworkWorkOrderSelect" class="form-select" name="rework_work_order" required>
            @foreach($client->work_orders as $work_order_stored)
            <option value="{{ $work_order_stored->id }}">#{{ $work_order_stored->id }} - {{ $work_order_stored->job->name }}</option>
            @endforeach
        </select>
    </div>

</x-form-field-horizontal>

