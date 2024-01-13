<div>
    <address>
        <span>{{ $contractor->street }}</span><br>
        <span>{{ $contractor->address_data->only(['city_name','state_name','country_name'])->implode(', ') }}</span><br>
        <span>ZIP {{ $contractor->zip_code }}</span><br>
    </address>
</div>
