<div>
    <address class="d-inline-block m-0">
        {{ $client->full_name }}, 
        {{ $client->street }}, 
        {{ $client->locationDataImplode(', ', 'location_state_code') }}
        <b>{{ $client->zip_code }}</b>
    </address>
    <x-tooltip title="Google Maps">
        <a href="{{ $client->url_search_address_google_maps }}" target="__blank">
            <i class="bi bi-geo-alt-fill"></i>
        </a>
    </x-tooltip>
</div>
<div>
    @foreach($client->contact_data_collection->filter() as $key => $value)
        <x-tooltip title="{{ ucfirst($key) }}">
            <span class="badge text-bg-light">
                <?php $prefix = $key <> 'email' ? 'tel' : 'mailto' ?> 
                <a href="{{ $prefix }}:{{ $value }}">{{ $value }}</a>
            </span>
        </x-tooltip>
    @endforeach
</div>
