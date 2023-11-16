<div class="row align-items-center mb-3">
    <div class="col-md">
        <label for="nameInput" class="form-label">Name</label>
    </div>
    <div class="col-md col-md-9 col-lg-10">
        <input id="nameInput" type="text" class="form-control {{ bsInputInvalid( $errors->has('name') ) }}" name="name" value="{{ old('name', $intermediary->name) }}">
        <x-error name="name" />
    </div>
</div>
<div class="row align-items-center mb-3">
    <div class="col-md">
        <label for="aliasInput" class="form-label">Alias</label>
    </div>
    <div class="col-md col-md-9 col-lg-10">
        <input id="aliasInput" type="text" class="form-control {{ bsInputInvalid( $errors->has('alias') ) }}" name="alias" value="{{ old('alias', $intermediary->alias) }}">
        <x-error name="alias" />
    </div>
</div>
<div class="row align-items-center mb-3">
    <div class="col-md">
        <label for="contactInput" class="form-label">Contact</label>
    </div>
    <div class="col-md col-md-9 col-lg-10">
        <input id="contactInput" type="text" class="form-control {{ bsInputInvalid( $errors->has('contact') ) }}" name="contact" value="{{ old('contact', $intermediary->contact) }}">
        <x-error name="contact" />
    </div>
</div>
<div class="row align-items-center mb-3">
    <div class="col-md">
        <label for="emailInput" class="form-label">Email</label>
    </div>
    <div class="col-md col-md-9 col-lg-10">
        <input id="emailInput" type="email" class="form-control {{ bsInputInvalid( $errors->has('email') ) }}" name="email" value="{{ old('email', $intermediary->email) }}">
        <x-error name="email" />
    </div>
</div>
<div class="row align-items-center mb-3">
    <div class="col-md">
        <label for="phoneNumberInput" class="form-label">Phone</label>
    </div>
    <div class="col-md col-md-9 col-lg-10">
        <input id="phoneNumberInput" type="text" class="form-control {{ bsInputInvalid( $errors->has('phone_number') ) }}" name="phone_number" value="{{ old('phone_number', $intermediary->phone_number) }}">
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

        <select id="countrySelect" class="form-select {{ bsInputInvalid( $errors->has('country_code') ) }}" name="country_code">
            @foreach($countries as $code => $country)

            <?php $is_country_selected = (old('country_code', $intermediary->country_code) ?? $default->get('country_code')) == $code; ?>

            <option value="{{ $code }}" {{ isSelected( $is_country_selected ) }}>{{ $country->get('name') }}</option>
            
            @endforeach
        </select>
        <x-error name="country_code" />

    </div>
</div>
<div class="row align-items-center mb-3">
    <div class="col-md">
        <label for="stateSelect" class="form-label">State</label>
    </div>
    <div class="col-md col-md-9 col-lg-10">

        <?php $country_selected = $countries->get( old('country_code', $intermediary->country_code) ) ?? $countries->get( $default->get('country_code') ); ?>

        <select id="stateSelect" class="form-select {{ bsInputInvalid( $errors->has('state_code') ) }}" name="state_code">
            @foreach($country_selected->get('states') as $code => $state)
            
            <?php $is_state_selected = (old('state_code', $intermediary->state_code) ?? $default->get('state_code')) == $code ?>
            
            <option value="{{ $code }}" {{ isSelected( $is_state_selected ) }}>{{ $state }}</option>
            
            @endforeach
        </select>
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
        <textarea id="notesTextarea" class="form-control {{ bsInputInvalid( $errors->has('notes') ) }}" rows="5" name="notes">{{ old('notes', $intermediary->notes) }}</textarea>
        <x-error name="notes" />
    </div>
</div>
@csrf