@csrf

<x-form-field-horizontal for="nameInput" label="Name">
    <input id="nameInput" type="text" class="form-control {{ bsInputInvalid( $errors->has('name') ) }}" name="name" value="{{ old('name', $contractor->name) }}" required>
    <x-error name="name" />
</x-form-field-horizontal>

<x-form-field-horizontal for="aliasInput" label="Alias">
    <input id="aliasInput" type="text" class="form-control {{ bsInputInvalid( $errors->has('alias') ) }}" name="alias" value="{{ old('alias', $contractor->alias) }}" required>
    <x-error name="alias" />
</x-form-field-horizontal>

<x-form-field-horizontal for="contactNameInput" label="Contact name">
    <input id="contactNameInput" type="text" class="form-control {{ bsInputInvalid( $errors->has('contact_name') ) }}" name="contact_name" value="{{ old('contact_name', $contractor->contact_name) }}" required>
    <x-error name="contact_name" />
</x-form-field-horizontal>

<x-form-field-horizontal for="phoneNumberInput" label="Phone">
    <input id="phoneNumberInput" type="text" class="form-control {{ bsInputInvalid( $errors->has('phone_number') ) }}" name="phone_number" value="{{ old('phone_number', $contractor->phone_number) }}" required>
    <x-error name="phone_number" />
</x-form-field-horizontal>

<x-form-field-horizontal for="mobileNumberInput" label="Mobile" label-class="form-label-optional">
    <input id="mobileNumberInput" type="text" class="form-control {{ bsInputInvalid( $errors->has('mobile_number') ) }}" name="mobile_number" value="{{ old('mobile_number', $contractor->mobile_number) }}">
    <x-error name="mobile_number" />
</x-form-field-horizontal>

<x-form-field-horizontal for="emailInput" label="Email" label-class="form-label-optional">
    <input id="emailInput" type="email" class="form-control {{ bsInputInvalid( $errors->has('email') ) }}" name="email" value="{{ old('email', $contractor->email) }}">
    <x-error name="email" />
</x-form-field-horizontal>

<x-form-field-horizontal for="streetInput" label="Street">
    <input id="streetInput" type="text" class="form-control {{ bsInputInvalid( $errors->has('street') ) }}" name="street" value="{{ old('street', $contractor->street) }}">
    <x-error name="street" />
</x-form-field-horizontal>

<x-form-field-horizontal for="cityNameInput" label="City">
    <x-custom.input-city-name-data :old="old('city_name', $contractor->city_name)" required />
    <x-error name="city_name" />
</x-form-field-horizontal>

<x-form-field-horizontal for="stateCodeSelect" label="State">
    <x-custom.select-state-code-data :country="old('country_code', $contractor->country_code)" :old="old('state_code', $contractor->state_code)" required />
    <x-error name="state_code" />
</x-form-field-horizontal>

<x-form-field-horizontal for="countryCodeSelect" label="Country">
    <x-custom.select-country-code-data :old="old('country_code', $contractor->country_code)" required />
    <x-error name="country_code" />
</x-form-field-horizontal>

<x-form-field-horizontal for="zipCodeInput" label="Zip code">
    <input id="zipCodeInput" type="text" class="form-control {{ bsInputInvalid( $errors->has('zip_code') ) }}" name="zip_code" value="{{ old('zip_code', $contractor->zip_code) }}">
    <x-error name="zip_code" />
</x-form-field-horizontal>

<x-form-field-horizontal for="notesTextarea" label="Notes" label-class="form-label-optional">
    <textarea id="notesTextarea" class="form-control {{ bsInputInvalid( $errors->has('notes') ) }}" rows="3" name="notes">{{ old('notes', $contractor->notes) }}</textarea>
    <x-error name="notes" />
</x-form-field-horizontal>
