<div class="mt-3 {{ old('type') <> 'warranty' ? 'd-none' : '' }}">
    <select id="warrantySelect" class="form-select {{ bsInputInvalid( $errors->has('warranty') ) }}" name="warranty" {{ isDisabled( old('type') <> 'warranty' ) }}>
        @foreach($client->work_orders as $wo)
        
            @if( $wo->qualifiesForWarranty() )
            <option value="{{ $wo->id }}">#{{ $wo->id }} - {{ $wo->job->name }}</option>
            @endif
        
        @endforeach
    </select>
    <x-form-feedback error="warranty" important>
        Only client work orders with <b>{{ \App\Models\WorkOrder::getWarrantyStatuses()->implode(', ') }} status</b>
    </x-form-feedback>
</div>
