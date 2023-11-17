<div class="row align-items-center mb-3">
    <div class="col-md">
        <label for="nameInput" class="form-label">Name</label>
    </div>
    <div class="col-md col-md-9 col-lg-10">
        <input id="nameInput" type="text" class="form-control {{ bsInputInvalid( $errors->has('name') ) }}" name="name" value="{{ old('name', $intermediary->name) }}" required>
        <x-error name="name" />
    </div>
</div>
<div class="row align-items-center mb-3">
    <div class="col-md">
        <label for="aliasInput" class="form-label">Alias</label>
    </div>
    <div class="col-md col-md-9 col-lg-10">
        <input id="aliasInput" type="text" class="form-control {{ bsInputInvalid( $errors->has('alias') ) }}" name="alias" value="{{ old('alias', $intermediary->alias) }}" required>
        <x-error name="alias" />
    </div>
</div>
<div class="row align-items-center mb-3">
    <div class="col-md">
        <label for="contactInput" class="form-label">Contact</label>
    </div>
    <div class="col-md col-md-9 col-lg-10">
        <input id="contactInput" type="text" class="form-control {{ bsInputInvalid( $errors->has('contact') ) }}" name="contact" value="{{ old('contact', $intermediary->contact) }}" required>
        <x-error name="contact" />
    </div>
</div>
<div class="row align-items-center mb-3">
    <div class="col-md">
        <label for="phoneNumberInput" class="form-label">Phone</label>
    </div>
    <div class="col-md col-md-9 col-lg-10">
        <input id="phoneNumberInput" type="text" class="form-control {{ bsInputInvalid( $errors->has('phone_number') ) }}" name="phone_number" value="{{ old('phone_number', $intermediary->phone_number) }}" required>
        <x-error name="phone_number" />
    </div>
</div>
<div class="row align-items-center mb-3">
    <div class="col-md">
        <label for="mobileNumberInput" class="form-label form-label-optional">Mobile</label>
    </div>
    <div class="col-md col-md-9 col-lg-10">
        <input id="mobileNumberInput" type="text" class="form-control {{ bsInputInvalid( $errors->has('mobile_number') ) }}" name="mobile_number" value="{{ old('mobile_number', $intermediary->mobile_number) }}">
        <x-error name="mobile_number" />
    </div>
</div>
<div class="row align-items-center mb-3">
    <div class="col-md">
        <label for="emailInput" class="form-label form-label-optional">Email</label>
    </div>
    <div class="col-md col-md-9 col-lg-10">
        <input id="emailInput" type="email" class="form-control {{ bsInputInvalid( $errors->has('email') ) }}" name="email" value="{{ old('email', $intermediary->email) }}">
        <x-error name="email" />
    </div>
</div>
<div class="row align-items-center mb-3">
    <div class="col-md">
        <label for="streetInput" class="form-label form-label-optional">Street</label>
    </div>
    <div class="col-md col-md-9 col-lg-10">
        <input id="streetInput" type="text" class="form-control {{ bsInputInvalid( $errors->has('street') ) }}" name="street" value="{{ old('street', $intermediary->street) }}">
        <x-error name="street" />
    </div>
</div>
<div class="row align-items-center mb-3">
    <div class="col-md">
        <label for="zipCodeInput" class="form-label form-label-optional">Zip code</label>
    </div>
    <div class="col-md col-md-9 col-lg-10">
        <input id="zipCodeInput" type="text" class="form-control {{ bsInputInvalid( $errors->has('zip_code') ) }}" name="zip_code" value="{{ old('zip_code', $intermediary->zip_code) }}">
        <x-error name="zip_code" />
    </div>
</div>
<div class="row align-items-center mb-3">
    <div class="col-md">
        <label for="countrySelect" class="form-label">Country</label>
    </div>
    <div class="col-md col-md-9 col-lg-10">
        <x-custom.select-country-code :old="old('country_code', $intermediary->country_code)" required />
        <x-error name="country_code" />
    </div>
</div>
<div class="row align-items-center mb-3">
    <div class="col-md">
        <label for="stateSelect" class="form-label">State</label>
    </div>
    <div class="col-md col-md-9 col-lg-10">
        <x-custom.select-state-code :country="old('country_code', $intermediary->country_code)" :old="old('state_code', $intermediary->state_code)" required />
        <x-error name="state_code" />
    </div>
</div>
<div class="row align-items-center mb-3">
    <div class="col-md">
        <label for="cityInput" class="form-label">City</label>
    </div>
    <div class="col-md col-md-9 col-lg-10">
        <input id="cityInput" type="text" class="form-control {{ bsInputInvalid( $errors->has('city') ) }}" name="city" value="{{ old('city', ($intermediary->city ?? 'San Antonio')) }}">
        <x-error name="city" />
    </div>
</div>
<div class="row mb-3">
    <div class="col-md">
        <label for="notesTextarea" class="form-label form-label-optional">Notes</label>
    </div>
    <div class="col-md col-md-9 col-lg-10">
        <textarea id="notesTextarea" class="form-control {{ bsInputInvalid( $errors->has('notes') ) }}" rows="3" name="notes">{{ old('notes', $intermediary->notes) }}</textarea>
        <x-error name="notes" />
    </div>
</div>
@csrf