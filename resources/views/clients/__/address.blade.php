<div>
    <address>
        {{ $client->street }} 
        @include('clients.__.link-google-maps')
        <br>
    
        {{ $client->city_name }},
        {{ $client->state_name }},
        {{ $client->country_code }}
        <br>

        {{ $client->zip_code }}
        <br>
        
        @if( $client->hasDistrictCode() )
        Council District {{ $client->district_code }}
        @endif
    </address>
</div>
