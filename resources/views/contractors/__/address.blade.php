<div>
    <address>
        {{ $contractor->street }}
        <br>

        {{ $contractor->address_data->only(['city_name','state_name','country_code'])->implode(', ') }}
        <br>

        {{ $contractor->zip_code }}
    </address>
</div>
