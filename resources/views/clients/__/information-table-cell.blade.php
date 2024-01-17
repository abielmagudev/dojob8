<?php $city_state_country = $client->address_data->filter()->only(['city_name', 'state_name', 'country_code'])->implode(', ') ?>

<div>
    <address class="d-inline-block m-0">
        <span>{!! $client->street !!}</span>, 
        <span>{!! $city_state_country !!}</span>
        <b>{!! $client->zip_code !!}</b>
    </address>
    <x-tooltip title="Google Maps">
        <a href="{{ $client->url_search_address_google_maps }}" target="__blank">
            <i class="bi bi-geo-alt-fill"></i>
        </a>
    </x-tooltip>
</div>
<div>
    <small>{{ $client->full_name }}</small>
    <div class="d-inline-block">
        <x-custom.tooltip-contact-channels :channels="$client->contact_data->filter()" />
    </div>
</div>
