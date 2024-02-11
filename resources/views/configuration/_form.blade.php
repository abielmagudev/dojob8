<h6 class="text-secondary mb-3">Customer</h6>
<div class="mb-3">
    <label for="companyNameInput" class="form-label">Company</label>
    <input id="companyNameInput" type="text" class="form-control {{ bsInputInvalid( $errors->has('company_name') ) }}" name="company_name" value="{{ old('company_name', $configuration->get('company_name')) }}" autofocus required>
    <x-form-feedback error="company_name" />
</div>
<br>

<h6 class="text-secondary mb-3">Location</h6>
<div class="mb-3">
    <label for="cityNameInput" class="form-label">City</label>
    <x-custom.input-city-name-data required>{{ old('city_name') }}</x-custom.input-city-name-data>
    <x-form-feedback error="city_name" />
</div>
<div class="mb-3">
    <label for="stateCodeSelect" class="form-label">State</label>
    <x-custom.select-state-code-data country="{{ $configuration->get('country_code') }}" required>{{ old('state_code') }}</x-custom.select-state-code-data>
    <x-form-feedback error="state_code" />
</div>
<div class="mb-3">
    <label for="countryCodeSelect" class="form-label">Country</label>
    <x-custom.select-country-code-data required>{{ old('country_code') }}</x-custom.select-country-code-data>
    <x-form-feedback error="country_code" />
</div>
<br>
