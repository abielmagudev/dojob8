<div>
    <address>
        {{ $client->street }} 
        @include('clients.__.link-google-maps')
        <br>
    
        {{ $client->city_name }},
        {{ $client->state_name }},
        {{ $client->country_code }}
        <br>
    
        @if( $client->hasDistrictCode() )
        {{ $client->district_code }}
        <em class="small">(District code)</em>
        <br>
        @endif

        <b>{{ $client->zip_code }}</b>
    </address>
</div>
