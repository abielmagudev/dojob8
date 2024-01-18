<div>
    <div>
        {{ $client->street }}, 
        {{ $client->city_name }},
        {{ $client->state_name }},
        {{-- {{ $client->country_code }}, --}}

        @if( $client->hasDistrictCode() && false )
        DC {{ $client->district_code }},
        @endif

        <b>{{ $client->zip_code }}</b>
        @include('clients.__.link-google-maps')
    </div>
    <div>
        <small>{{ $client->full_name }}</small>
        <div class="d-inline-block">
            <x-custom.information-contact-channels 
                :channels="$client->contact_data->filter()" 
                item-class="d-inline-block small mx-1"
                type="tooltip"
            />
        </div>
    </div>
</div>
