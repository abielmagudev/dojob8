<div class="mt-3 {{ old('type') <> 'rework' ? 'd-none' : '' }}">
    <select id="reworkSelect" class="form-select {{ bsInputInvalid( $errors->has('rework') ) }}" name="rework" {{ isDisabled( old('type') <> 'rework' ) }}>
        @foreach($client->work_orders as $wo)
        
            @if( $wo->qualifiesForRework() )
            <option value="{{ $wo->id }}">#{{ $wo->id }} - {{ $wo->job->name }}</option>
            @endif
            
        @endforeach
    </select>
    <x-form-feedback error="rework" important>
        Only client work orders with <b>{{ \App\Models\WorkOrder::getReworkStatuses()->implode(', ') }} status</b>
    </x-form-feedback>
</div>
