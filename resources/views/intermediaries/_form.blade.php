@csrf
<x-custom.form-control-horizontal class="align-items-center">
    <x-slot name="label">
        <label for="nameInput" class="form-label">Name</label>
    </x-slot>

    <input id="nameInput" type="text" class="form-control {{ bsInputInvalid( $errors->has('name') ) }}" name="name" value="{{ old('name', $intermediary->name) }}" required>
    <x-error name="name" />
</x-custom.form-control-horizontal>

<x-custom.form-control-horizontal class="align-items-center">
    <x-slot name="label">
        <label for="aliasInput" class="form-label">Alias</label>
    </x-slot>

    <input id="aliasInput" type="text" class="form-control {{ bsInputInvalid( $errors->has('alias') ) }}" name="alias" value="{{ old('alias', $intermediary->alias) }}" required>
    <x-error name="alias" />
</x-custom.form-control-horizontal>

<x-custom.form-control-horizontal class="align-items-center">
    <x-slot name="label">
        <label for="contactInput" class="form-label">Contact</label>
    </x-slot>
    
    <input id="contactInput" type="text" class="form-control {{ bsInputInvalid( $errors->has('contact') ) }}" name="contact" value="{{ old('contact', $intermediary->contact) }}" required>
    <x-error name="contact" />
</x-custom.form-control-horizontal>

<x-custom.form-control-horizontal class="align-items-center">
    <x-slot name="label">
        <label for="phoneNumberInput" class="form-label">Phone</label>
    </x-slot>

    <input id="phoneNumberInput" type="text" class="form-control {{ bsInputInvalid( $errors->has('phone_number') ) }}" name="phone_number" value="{{ old('phone_number', $intermediary->phone_number) }}" required>
    <x-error name="phone_number" />
</x-custom.form-control-horizontal>

<x-custom.form-control-horizontal class="align-items-center">
    <x-slot name="label">
        <label for="mobileNumberInput" class="form-label form-label-optional">Mobile</label>
    </x-slot>

    <input id="mobileNumberInput" type="text" class="form-control {{ bsInputInvalid( $errors->has('mobile_number') ) }}" name="mobile_number" value="{{ old('mobile_number', $intermediary->mobile_number) }}">
    <x-error name="mobile_number" />
</x-custom.form-control-horizontal>

<x-custom.form-control-horizontal class="align-items-center">
    <x-slot name="label">
        <label for="emailInput" class="form-label form-label-optional">Email</label>
    </x-slot>

    <input id="emailInput" type="email" class="form-control {{ bsInputInvalid( $errors->has('email') ) }}" name="email" value="{{ old('email', $intermediary->email) }}">
    <x-error name="email" />
</x-custom.form-control-horizontal>

<x-custom.form-control-horizontal class="align-items-center">
    <x-slot name="label">
        <label for="streetInput" class="form-label">Street</label>
    </x-slot>

    <input id="streetInput" type="text" class="form-control {{ bsInputInvalid( $errors->has('street') ) }}" name="street" value="{{ old('street', $intermediary->street) }}">
    <x-error name="street" />
</x-custom.form-control-horizontal>

<x-custom.form-control-horizontal class="align-items-center">
    <x-slot name="label">
        <label for="cityInput" class="form-label">City</label>
    </x-slot>

    <input id="cityInput" type="text" class="form-control {{ bsInputInvalid( $errors->has('city') ) }}" name="city" value="{{ old('city', ($intermediary->city ?? 'San Antonio')) }}">
    <x-error name="city" />
</x-custom.form-control-horizontal>

<x-custom.form-control-horizontal class="align-items-center">
    <x-slot name="label">
        <label for="stateCodeSelect" class="form-label">State</label>
    </x-slot>

    <x-custom.select-state-code :country="old('country_code', $intermediary->country_code)" :old="old('state_code', $intermediary->state_code)" required />
    <x-error name="state_code" />
</x-custom.form-control-horizontal>

<x-custom.form-control-horizontal class="align-items-center">
    <x-slot name="label">
        <label for="countryCodeSelect" class="form-label">Country</label>
    </x-slot>

    <x-custom.select-country-code :old="old('country_code', $intermediary->country_code)" required />
    <x-error name="country_code" />
</x-custom.form-control-horizontal>

<x-custom.form-control-horizontal class="align-items-center">
    <x-slot name="label">
        <label for="zipCodeInput" class="form-label">Zip code</label>
    </x-slot>

    <input id="zipCodeInput" type="text" class="form-control {{ bsInputInvalid( $errors->has('zip_code') ) }}" name="zip_code" value="{{ old('zip_code', $intermediary->zip_code) }}">
    <x-error name="zip_code" />
</x-custom.form-control-horizontal>

<x-custom.form-control-horizontal>
    <x-slot name="label">
        <label for="notesTextarea" class="form-label form-label-optional">Notes</label>
    </x-slot>

    <textarea id="notesTextarea" class="form-control {{ bsInputInvalid( $errors->has('notes') ) }}" rows="3" name="notes">{{ old('notes', $intermediary->notes) }}</textarea>
    <x-error name="notes" />
</x-custom.form-control-horizontal>

@if( $intermediary->id )
<br>
<div class="mb-3">
    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" role="switch" id="availableSwitch" name="available" value="1" {{ isChecked( $intermediary->isAvailable() ) }}>
        <label class="form-check-label" for="availableSwitch">
            <b>Available.</b>
            <span>If you deactivate this option, you will not be able to use this intermediary for new orders and all of his user accounts will also be deactivated.</span>
        </label>
    </div>
</div>
@endif
