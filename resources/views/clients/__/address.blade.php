<div>
    <address>
        <span>{{ $client->full_name }}</span><br>
        <span>{{ $client->street }}</span><br>
        <span>{{ $client->city_name }}, {{ $client->state_code }}, {{ $client->country_name }}</span><br>
        <span>Zip {{ $client->zip_code }}</span><br>
        <span>District {{ $client->district_code }}</span><br>
    </address>
</div>
