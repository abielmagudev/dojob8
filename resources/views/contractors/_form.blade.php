@csrf
<x-form-control-horizontal class="align-items-center">
    <x-slot name="label">
        <label for="nameInput" class="form-label">Name</label>
    </x-slot>

    <input id="nameInput" type="text" class="form-control {{ bsInputInvalid( $errors->has('name') ) }}" name="name" value="{{ old('name', $contractor->name) }}" required>
    <x-error name="name" />
</x-form-control-horizontal>

<x-form-control-horizontal class="align-items-center">
    <x-slot name="label">
        <label for="aliasInput" class="form-label">Alias</label>
    </x-slot>

    <input id="aliasInput" type="text" class="form-control {{ bsInputInvalid( $errors->has('alias') ) }}" name="alias" value="{{ old('alias', $contractor->alias) }}" required>
    <x-error name="alias" />
</x-form-control-horizontal>

<x-form-control-horizontal class="align-items-center">
    <x-slot name="label">
        <label for="contactNameInput" class="form-label">Contact name</label>
    </x-slot>
    
    <input id="contactNameInput" type="text" class="form-control {{ bsInputInvalid( $errors->has('contact_name') ) }}" name="contact_name" value="{{ old('contact_name', $contractor->contact_name) }}" required>
    <x-error name="contact_name" />
</x-form-control-horizontal>

<x-form-control-horizontal class="align-items-center">
    <x-slot name="label">
        <label for="phoneNumberInput" class="form-label">Phone</label>
    </x-slot>

    <input id="phoneNumberInput" type="text" class="form-control {{ bsInputInvalid( $errors->has('phone_number') ) }}" name="phone_number" value="{{ old('phone_number', $contractor->phone_number) }}" required>
    <x-error name="phone_number" />
</x-form-control-horizontal>

<x-form-control-horizontal class="align-items-center">
    <x-slot name="label">
        <label for="mobileNumberInput" class="form-label form-label-optional">Mobile</label>
    </x-slot>

    <input id="mobileNumberInput" type="text" class="form-control {{ bsInputInvalid( $errors->has('mobile_number') ) }}" name="mobile_number" value="{{ old('mobile_number', $contractor->mobile_number) }}">
    <x-error name="mobile_number" />
</x-form-control-horizontal>

<x-form-control-horizontal class="align-items-center">
    <x-slot name="label">
        <label for="emailInput" class="form-label form-label-optional">Email</label>
    </x-slot>

    <input id="emailInput" type="email" class="form-control {{ bsInputInvalid( $errors->has('email') ) }}" name="email" value="{{ old('email', $contractor->email) }}">
    <x-error name="email" />
</x-form-control-horizontal>

<x-form-control-horizontal class="align-items-center">
    <x-slot name="label">
        <label for="streetInput" class="form-label">Street</label>
    </x-slot>

    <input id="streetInput" type="text" class="form-control {{ bsInputInvalid( $errors->has('street') ) }}" name="street" value="{{ old('street', $contractor->street) }}">
    <x-error name="street" />
</x-form-control-horizontal>

<x-form-control-horizontal class="align-items-center">
    <x-slot name="label">
        <label for="cityInput" class="form-label">City</label>
    </x-slot>

    <x-custom.input-city :old="old('city', $contractor->city)" required />
    <x-error name="city" />
</x-form-control-horizontal>

<x-form-control-horizontal class="align-items-center">
    <x-slot name="label">
        <label for="stateCodeSelect" class="form-label">State</label>
    </x-slot>

    <x-custom.select-state-code :country="old('country_code', $contractor->country_code)" :old="old('state_code', $contractor->state_code)" required />
    <x-error name="state_code" />
</x-form-control-horizontal>

<x-form-control-horizontal class="align-items-center">
    <x-slot name="label">
        <label for="countryCodeSelect" class="form-label">Country</label>
    </x-slot>

    <x-custom.select-country-code :old="old('country_code', $contractor->country_code)" required />
    <x-error name="country_code" />
</x-form-control-horizontal>

<x-form-control-horizontal class="align-items-center">
    <x-slot name="label">
        <label for="zipCodeInput" class="form-label">Zip code</label>
    </x-slot>

    <input id="zipCodeInput" type="text" class="form-control {{ bsInputInvalid( $errors->has('zip_code') ) }}" name="zip_code" value="{{ old('zip_code', $contractor->zip_code) }}">
    <x-error name="zip_code" />
</x-form-control-horizontal>

<x-form-control-horizontal>
    <x-slot name="label">
        <label for="notesTextarea" class="form-label form-label-optional">Notes</label>
    </x-slot>

    <textarea id="notesTextarea" class="form-control {{ bsInputInvalid( $errors->has('notes') ) }}" rows="3" name="notes">{{ old('notes', $contractor->notes) }}</textarea>
    <x-error name="notes" />
</x-form-control-horizontal>

@if( $contractor->id )
<br>
<div class="mb-3">
    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" role="switch" id="availableSwitch" name="available" value="1" {{ isChecked( $contractor->isAvailable() ) }}>
        <label class="form-check-label" for="availableSwitch">
            <b>Available.</b>
            <span>If you deactivate this option, you will not be able to use this intermediary for new orders and all of his user accounts will also be deactivated.</span>
        </label>
    </div>
</div>
@endif
