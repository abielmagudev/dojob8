<?php $city_state_country = $client->address_data->filter()->only(['city_name', 'state_name', 'country_code'])->implode(', ') ?>

<div>
    <address class="d-inline-block m-0">
        {!! isset($mark) ? marker($mark, $client->street) : $client->street !!}, 
        {!! isset($mark) ? marker($mark, $city_state_country) : $city_state_country !!}
        <b>{!! isset($mark) ? marker($mark, $client->zip_code) : $client->zip_code !!}</b>
    </address>
    <x-tooltip title="Google Maps">
        <a href="{{ $client->url_search_address_google_maps }}" target="__blank">
            <i class="bi bi-geo-alt-fill"></i>
        </a>
    </x-tooltip>
</div>
