<x-form-field-horizontal for="warrantyTypeSelect" label="Warranty" label-class="form-label-optional">

    <div class="mb-3">
        <select id="warrantyTypeSelect" class="form-select" name="warranty_type">
            <option value="no" selected>No, it's not a warranty</option>
            <option value="maintenance">Maintenance warranty</option>
            <option value="warranty">Repair warranty</option>
        </select>
    </div>

    <div>
        <select id="warrantyWorkOrderSelect" class="form-select" name="warranty_work_order" required>
            @foreach($client->work_orders as $work_order_stored)
            <option value="{{ $work_order_stored->id }}">#{{ $work_order_stored->id }} - {{ $work_order_stored->job->name }}</option>
            @endforeach
        </select>
    </div>

</x-form-field-horizontal>

