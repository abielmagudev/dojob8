<address class="d-inline-block m-0">
    {{ $client->street }}, 
    {{ $client->address_data->filter()->only(['city_name', 'state_name', 'country_code'])->implode(', ') }}
    <b>{{ $client->zip_code }}</b>
</address>

<x-tooltip title="Google Maps">
    <a href="{{ $client->url_search_address_google_maps }}" target="__blank">
        <i class="bi bi-geo-alt-fill"></i>
    </a>
</x-tooltip>
