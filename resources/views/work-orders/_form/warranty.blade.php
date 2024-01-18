<div class="d-none mt-3">
    <select id="warrantySelect" class="form-select" name="warranty" disabled required>
        @foreach($client->work_orders as $wo)
        
            @if( $wo->qualifiesForWarranty() )
            <option value="{{ $wo->id }}">#{{ $wo->id }} - {{ $wo->job->name }}</option>
            @endif
        
        @endforeach
    </select>
    <x-form-helper important>Work orders with <b>close status</b></x-form-helper>
</div>
