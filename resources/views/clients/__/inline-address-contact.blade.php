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
    <div>
        {{ $collection_address->implode(', ') }}
        @include('clients.__.link-google-maps')
    </div>
    <div>
        <small>{{ $client->full_name }}</small>
        <div class="d-inline-block me-1">
            <x-custom.information-contact-channels 
            :channels="$client->contact_data->filter()" 
            item-class="d-inline-block small mx-1"
            type="tooltip"
            />
        </div>
    </div>
</div>
