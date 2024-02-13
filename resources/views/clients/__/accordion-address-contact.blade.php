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
        <a href="#!" class="toggle-information-accordion icon-link ms-1">
            <i class="bi bi-info-circle"></i>
        </a>
        {{ $collection_address->implode(', ') }}
        @include('clients.__.link-google-maps')
    </div>
    <div class="d-none information-accordion" style="margin-left:20px">
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

@once
@push('scripts')
<script>
const toggleInformation = {
    triggers: document.querySelectorAll('.toggle-information-accordion'),
    accordions: document.querySelectorAll('.information-accordion'),
    listen: function () {
        this.triggers.forEach(function (t) {
            t.addEventListener('click', function (evt) {
                evt.preventDefault()
                
                let classname_inactive = 'bi-info-circle';
                let classname_active = 'bi-info-circle-fill';

                evt.target.classList.replace(
                    evt.target.classList.contains(classname_inactive) ? classname_inactive : classname_active,  
                    evt.target.classList.contains(classname_inactive) ? classname_active : classname_inactive,  
                )
                this.parentNode.nextElementSibling.classList.toggle('d-none')
            })
        })
    }
}
toggleInformation.listen()
</script>
@endpush
@endonce
