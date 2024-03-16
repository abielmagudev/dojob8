<x-form-field-horizontal label="Client">
    
    <div class="form-control">
        <b>{{ $client->full_name }}</b>
        <br>
        <small>{{ $client->address_simple }}</small>
        <br>
        <small>{{ $client->contact_channels }}</small>
    </div>

    @if(! $work_order->client_id )
    <input type="hidden" name="client" value="{{ $client->id }}">  
    @endif

</x-form-field-horizontal>
