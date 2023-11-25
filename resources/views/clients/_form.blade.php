@csrf
<x-custom.form-control-horizontal>
    <x-slot name="label">
        <label for="nameInput" class="form-label">Name</label>
    </x-slot>

    <input id="nameInput" type="text" class="form-control" name="name" value="{{ old('name', $client->name) }}" placeholder="Name(s)" required>
    <x-error name="name" />
    
    <div class="mb-3"></div>

    <input id="lastNameInput" type="text" class="form-control" name="last_name" value="{{ old('last_name', $client->last_name) }}" placeholder="Last name" required>
    <x-error name="last_name" />
</x-custom.form-control-horizontal>

<x-custom.form-control-horizontal class="align-items-center">
    <x-slot name="label">
        <label for="streetInput" class="form-label">Street</label>
    </x-slot>

    <input id="streetInput" type="text" class="form-control" name="street" value="{{ old('street', $client->street) }}" required>
    <x-error name="street" />
</x-custom.form-control-horizontal>

<x-custom.form-control-horizontal class="align-items-center">
    <x-slot name="label">
        <label for="zipCodeInput" class="form-label">Zip code</label>
    </x-slot>
    
    <input id="zipCodeInput" type="text" class="form-control" name="zip_code" value="{{ old('zip_code', $client->zip_code) }}" required>
    <x-error name="zip_code" />
</x-custom.form-control-horizontal>

<x-custom.form-control-horizontal class="align-items-center">
    <x-slot name="label">
        <label for="countryCodeSelect" class="form-label">Country</label>
    </x-slot>

    <x-custom.select-country-code :old="old('country_code', $client->country_code)" required />
    <x-error name="country_code" />
</x-custom.form-control-horizontal>

<x-custom.form-control-horizontal class="align-items-center">
    <x-slot name="label">
        <label for="stateCodeSelect" class="form-label">State</label>
    </x-slot>

    <x-custom.select-state-code :country="old('country_code', $client->country_code)" :old="old('state_code', $client->state_code)" required />
    <x-error name="state_code" />
</x-custom.form-control-horizontal>

<x-custom.form-control-horizontal class="align-items-center">
    <x-slot name="label">
        <label for="cityInput" class="form-label">City</label>
    </x-slot>

    <x-custom.input-city :old="old('city', $client->city)" required />
    <x-error name="city" />
</x-custom.form-control-horizontal>

<x-custom.form-control-horizontal class="align-items-center">
    <x-slot name="label">
        <label for="phoneNumberInput" class="form-label">Phone</label>
    </x-slot>
    
    <input id="phoneNumberInput" type="text" class="form-control" name="phone_number" value="{{ old('phone_number', $client->phone_number) }}" required>
    <x-error name="phone_number" />
</x-custom.form-control-horizontal>

<x-custom.form-control-horizontal class="align-items-center">
    <x-slot name="label">
        <label for="mobileNumberInput" class="form-label form-label-optional">Mobile</label>
    </x-slot>
    
    <input id="mobileNumberInput" type="text" class="form-control" name="mobile_number" value="{{ old('mobile_number', $client->mobile_number) }}">
    <x-error name="mobile_number" />
</x-custom.form-control-horizontal>

<x-custom.form-control-horizontal class="align-items-center">
    <x-slot name="label">
        <label for="emailInput" class="form-label form-label-optional">Email</label>
    </x-slot>

    <input id="emailInput" type="text" class="form-control" name="email" value="{{ old('email', $client->email) }}">
    <x-error name="email" />
</x-custom.form-control-horizontal>

<x-custom.form-control-horizontal class="align-items-center">
    <x-slot name="label">
        <label for="notesTextarea" class="form-label form-label-optional">Notes</label>
    </x-slot>

    <textarea id="notesTextarea" class="form-control" rows="3" name="notes">{{ old('notes', $client->notes) }}</textarea>
    <x-error name="notes" />
</x-custom.form-control-horizontal>
