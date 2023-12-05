<?php if(! isset($except) ||! is_array($except) ) $except = [] ?>
<div>
    <address class="d-inline-block m-0">
        @if(! in_array('full_name', $except) )
        {{ $client->full_name }}, 
        @endif

        @if(! in_array('street', $except) )
        {{ $client->street }}, 
        @endif

        @if(! in_array('location', $except) )
        {{ $client->locationDataImplode(', ', 'location_state_code') }}
        @endif

        @if(! in_array('zip_code', $except) )
        <b>{{ $client->zip_code }}</b>
        @endif
    </address>
    @if(! in_array('google_maps', $except) )
    <x-tooltip title="Google Maps">
        <a href="{{ $client->url_search_address_google_maps }}" target="__blank">
            <i class="bi bi-geo-alt-fill"></i>
        </a>
    </x-tooltip>
    @endif
</div>
