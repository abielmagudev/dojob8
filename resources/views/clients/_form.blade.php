<div class="row mb-3">
    <div class="col-sm">
        <label for="inputName" class="form-label">Name</label>
    </div>
    <div class="col-sm col-md-9 col-lg-10">
        <input id="inputName" type="text" class="form-control" name="name" value="{{ old('name', $client->name) }}" placeholder="Name(s)" required>
        <x-error name="name" />
        <div class="mb-3"></div>
        <input id="inputLastname" type="text" class="form-control" name="lastname" value="{{ old('lastname', $client->lastname) }}" placeholder="Lastname" required>
        <x-error name="lastname" />
    </div>
</div>
<div class="row align-items-center mb-3">
    <div class="col-sm">
        <label for="inputStreet" class="form-label">Street</label>
    </div>
    <div class="col-sm col-md-9 col-lg-10">
        <input id="inputStreet" type="text" class="form-control" name="street" value="{{ old('street', $client->street) }}" required>
        <x-error name="street" />
    </div>
</div>
<div class="row align-items-center mb-3">
    <div class="col-sm">
        <label for="inputZipCode" class="form-label">Zip code</label>
    </div>
    <div class="col-sm col-md-9 col-lg-10">
        <input id="inputZipCode" type="text" class="form-control" name="zip_code" value="{{ old('zip_code', $client->zip_code) }}" required>
        <x-error name="zip_code" />
    </div>
</div>
<div class="row align-items-center mb-3">
    <div class="col-sm">
        <label for="inputCountry" class="form-label">Country</label>
    </div>
    <div class="col-sm col-md-9 col-lg-10">
        <x-custom.select-country-code :old="old('country_code', $client->country_code)" required />
        <x-error name="country_code" />
    </div>
</div>
<div class="row align-items-center mb-3">
    <div class="col-sm">
        <label for="stateCodeSelect" class="form-label">State</label>
    </div>
    <div class="col-sm col-md-9 col-lg-10">
        <x-custom.select-state-code :country="old('country_code', $client->country_code)" :old="old('state_code', $client->state_code)" required />
        <x-error name="state_code" />
    </div>
</div>
<div class="row align-items-center mb-3">
    <div class="col-sm">
        <label for="inputCity" class="form-label">City</label>
    </div>
    <div class="col-sm col-md-9 col-lg-10">
        <x-custom.input-city :old="old('city', $client->city)" required />
        <x-error name="city" />
    </div>
</div>
<div class="row align-items-center mb-3">
    <div class="col-sm">
        <label for="inputPhoneNumber" class="form-label">Phone</label>
    </div>
    <div class="col-sm col-md-9 col-lg-10">
        <input id="inputPhoneNumber" type="text" class="form-control" name="phone_number" value="{{ old('phone_number', $client->phone_number) }}" required>
        <x-error name="phone_number" />
    </div>
</div>
<div class="row align-items-center mb-3">
    <div class="col-sm">
        <label for="inputMobileNumber" class="form-label form-label-optional">Mobile</label>
    </div>
    <div class="col-sm col-md-9 col-lg-10">
        <input id="inputMobileNumber" type="text" class="form-control" name="mobile_number" value="{{ old('mobile_number', $client->mobile_number) }}">
        <x-error name="mobile_number" />
    </div>
</div>
<div class="row align-items-center mb-3">
    <div class="col-sm">
        <label for="inputEmail" class="form-label form-label-optional">Email</label>
    </div>
    <div class="col-sm col-md-9 col-lg-10">
        <input id="inputEmail" type="text" class="form-control" name="email" value="{{ old('email', $client->email) }}">
        <x-error name="email" />
    </div>
</div>
<div class="row mb-3">
    <div class="col-sm">
        <label for="textareaNotes" class="form-label form-label-optional">Notes</label>
    </div>
    <div class="col-md col-md-9 col-lg-10">
        <textarea id="textareaNotes" class="form-control" rows="3" name="notes">{{ old('notes', $client->notes) }}</textarea>
        <x-error name="notes" />
    </div>
</div>
@csrf
