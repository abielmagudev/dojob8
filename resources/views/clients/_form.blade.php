<div class="mb-3">
    <label for="inputName" class="form-label">Name</label>
    <input id="inputName" type="text" class="form-control" name="name" value="{{ old('name', $client->name) }}" required>
    <x-error name="name" />
</div>
<div class="mb-3">
    <label for="inputLastname" class="form-label">Lastname</label>
    <input id="inputLastname" type="text" class="form-control" name="lastname" value="{{ old('lastname', $client->lastname) }}" required>
    <x-error name="lastname" />
</div>
<div class="mb-3">
    <label for="inputAddress" class="form-label">Address</label>
    <input id="inputAddress" type="text" class="form-control" name="address" value="{{ old('address', $client->address) }}" required>
    <x-error name="address" />
</div>
<div class="mb-3">
    <label for="inputZipCode" class="form-label">Zip code</label>
    <input id="inputZipCode" type="text" class="form-control" name="zip_code" value="{{ old('zip_code', $client->zip_code) }}" required>
    <x-error name="zip_code" />
</div>
<div class="mb-3">
    <label for="inputCountry" class="form-label">Country</label>
    <input id="inputCountry" type="text" class="form-control" name="country" value="{{ old('country', ($client->country ?? 'United States')) }}" required>
    <x-error name="country" />
</div>
<div class="mb-3">
    <label for="inputState" class="form-label">State</label>
    <input id="inputState" type="text" class="form-control" name="state" value="{{ old('state', $client->state) }}" required>
    <x-error name="state" />
</div>
<div class="mb-3">
    <label for="inputCity" class="form-label">City</label>
    <input id="inputCity" type="text" class="form-control" name="city" value="{{ old('city', $client->city) }}" required>
    <x-error name="city" />
</div>
<div class="mb-3">
    <label for="inputPhoneNumber" class="form-label">Phone number <small class="text-secondary">(Optional)</small></label>
    <input id="inputPhoneNumber" type="text" class="form-control" name="phone_number" value="{{ old('phone_number', $client->phone_number) }}">
    <x-error name="phone_number" />
</div>
<div class="mb-3">
    <label for="inputMobileNumber" class="form-label">Mobile number <small class="text-secondary">(Optional)</small></label>
    <input id="inputMobileNumber" type="text" class="form-control" name="mobile_number" value="{{ old('mobile_number', $client->mobile_number) }}">
    <x-error name="mobile_number" />
</div>
<div class="mb-3">
    <label for="inputEmail" class="form-label">Email <small class="text-secondary">(Optional)</small></label>
    <input id="inputEmail" type="text" class="form-control" name="email" value="{{ old('email', $client->email) }}">
    <x-error name="email" />
</div>
<div class="mb-3">
    <label for="textareaNotes" class="form-label">Notes <small class="text-secondary">(Optional)</small></label>
    <textarea id="textareaNotes" class="form-control" rows="3" name="notes">{{ old('notes', $client->notes) }}</textarea>
    <x-error name="notes" />
</div>
@csrf
