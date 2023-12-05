<?php if(! isset($except) ||! is_array($except) ) $except = [] ?>
<address>
    @if(! in_array('full_name', $except) )
    <span>{{ $client->full_name }}</span><br>
    @endif

    @if(! in_array('street', $except) )
    <span>{{ $client->street }}</span><br>
    @endif

    @if(! in_array('location', $except) )
    <span>{{ $client->city }}, {{ $client->state_code }} {{ $client->zip_code }}</span><br>
    @endif

    @if(! in_array('country', $except) )
    <span>{{ $client->country_name }}</span><br>
    @endif

    @if(! in_array('district', $except) )
    <span>District {{ $client->district_code }}</span><br>
    @endif

    @if(! in_array('google_maps', $except) )
    <small>
        <a href="{{ $client->url_search_address_google_maps }}" target="_blank">Google Maps</a>
    </small>
    <br>
    @endif
</address>
