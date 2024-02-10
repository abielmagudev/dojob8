<div>
    <x-custom.information-contact-channels 
    :channels="$client->contact_data->filter()" 
    item-class="d-inline-block small mx-1"
    type="tooltip"
    />
</div>
