<?php $collection_address = collect([
    $client->street, 
    $client->city_name,
    $client->state_code,
    // $client->state_name,
    // $client->country_code,
    $client->zip_code,
    $client->hasDistrictCode() ? "CD {$client->district_code}" : null,
])->filter() ?>

<div>
    {{ $collection_address->implode(', ') }}
    @include('clients.__.link-google-maps')
</div>
