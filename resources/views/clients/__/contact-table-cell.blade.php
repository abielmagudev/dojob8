<div>
    <div class="d-flex">
        <div>
            <small>{{ $client->full_name }}</small>
        </div>
        <div>
            <x-custom.tooltip-contact-channels :channels="$client->contact_data->filter()" />
        </div>
    </div>
</div>
