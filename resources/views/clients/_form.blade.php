<x-form-field-horizontal for="nameInput" label="Name">
    <div class="row">
        <div class="col-md mb-3 mb-md-0">
            <input id="nameInput" type="text" class="form-control {{ bsInputInvalid($errors->has('name')) }}" name="name" value="{{ old('name', $client->name) }}" placeholder="Name(s)" autofocus required>
            <x-form-feedback error="name" />
        </div>
        <div class="col-md">
            <input id="lastNameInput" type="text" class="form-control {{ bsInputInvalid($errors->has('last_name')) }}" name="last_name" value="{{ old('last_name', $client->last_name) }}" placeholder="Last name" required>
            <x-form-feedback error="last_name" />
        </div>
    </div>
</x-form-field-horizontal>

<x-form-field-horizontal for="emailInput" label="Email" label-class="form-label-optional">
    <input id="emailInput" type="text" class="form-control {{ bsInputInvalid($errors->has('email')) }}" name="email" value="{{ old('email', $client->email) }}">
    <x-form-feedback error="email" />
</x-form-field-horizontal>

<x-form-field-horizontal for="mobileNumberInput" label="Mobile" label-class="form-label-optional">    
    <input id="mobileNumberInput" type="text" class="form-control {{ bsInputInvalid($errors->has('mobile_number')) }}" name="mobile_number" value="{{ old('mobile_number', $client->mobile_number) }}">
    <x-form-feedback error="mobile_number" />
</x-form-field-horizontal>

<x-form-field-horizontal for="phoneNumberInput" label="Phone" label-class="form-label-optional">
    <input id="phoneNumberInput" type="text" class="form-control {{ bsInputInvalid($errors->has('phone_number')) }}" name="phone_number" value="{{ old('phone_number', $client->phone_number) }}">
    <x-form-feedback error="phone_number" />
</x-form-field-horizontal>

<x-form-field-horizontal for="streetInput" label="Street">
    <input id="streetInput" type="text" class="form-control {{ bsInputInvalid($errors->has('street')) }}" name="street" value="{{ old('street', $client->street) }}" required>
    <x-form-feedback error="street" />
</x-form-field-horizontal>

<x-form-field-horizontal for="cityNameInput" label="City">
    <x-custom.input-city-name-data required>{{ old('city_name', $client->city_name) }}</x-custom.input-city-name-data>
    <x-form-feedback error="city_name" />
</x-form-field-horizontal>

<x-form-field-horizontal for="stateCodeSelect" label="State">
    <x-custom.select-state-code-data :country="old('country_code', $client->country_code)" required>{{ old('state_code', $client->state_code) }}</x-custom.select-state-code-data>
    <x-form-feedback error="state_code" />
</x-form-field-horizontal>

<x-form-field-horizontal for="countryCodeSelect" label="Country">
    <x-custom.select-country-code-data required>{{ old('country_code', $client->country_code) }}</x-custom.select-country-code-data>
    <x-form-feedback error="country_code" />
</x-form-field-horizontal>

<x-form-field-horizontal for="zipCodeInput" label="Zip code">
    <input id="zipCodeInput" type="text" class="form-control {{ bsInputInvalid($errors->has('zip_code')) }}" name="zip_code" value="{{ old('zip_code', $client->zip_code) }}" required>
    <x-form-feedback error="zip_code" />
</x-form-field-horizontal>

<x-form-field-horizontal for="districtCodeInput" label="Council District" label-class="form-label-optional">
    <input id="districtCodeInput" type="text" class="form-control {{ bsInputInvalid($errors->has('district_code')) }}" name="district_code" value="{{ old('district_code', $client->district_code) }}">
    <x-form-feedback error="district_code" />
</x-form-field-horizontal>

<x-form-field-horizontal for="notesTextarea" label="Notes" label-class="form-label-optional">
    <textarea id="notesTextarea" class="form-control {{ bsInputInvalid($errors->has('notes')) }}" rows="3" name="notes">{{ old('notes', $client->notes) }}</textarea>
    <x-form-feedback error="notes" />
</x-form-field-horizontal>
