@csrf

<x-form-field-horizontal for="nameInput" label="Name">
    <div class="row">
        <div class="col-md mb-3 mb-md-0">
            <input id="nameInput" type="text" class="form-control" name="name" value="{{ old('name', $member->name) }}" placeholder="Name" required>
            <x-error name="name" />
        </div>
        <div class="col-md">
            <input id="lastNameInput" type="text" class="form-control" name="last_name" value="{{ old('last_name', $member->last_name) }}" placeholder="Last name" required>
            <x-error name="last_name" />
        </div>
    </div>
</x-form-field-horizontal>

<x-form-field-horizontal for="birthdateInput" label="Birthdate" label-class="form-label-optional">
    <input id="birthdateInput" type="date" class="form-control" name="birthdate" value="{{ old('birthdate', $member->birthdate_input) }}">
    <x-error name="birthdate" />
</x-form-field-horizontal>

<x-form-field-horizontal for="phoneNumberInput" label="Phone number" label-class="form-label-optional">
    <input id="phoneNumberInput" type="text" class="form-control" name="phone_number" value="{{ old('phone_number', $member->phone_number) }}">
    <x-error name="phone_number" />
</x-form-field-horizontal>

<x-form-field-horizontal for="mobileNumberInput" label="Mobile number" label-class="form-label-optional">
    <input id="mobileNumberInput" type="text" class="form-control" name="mobile_number" value="{{ old('mobile_number', $member->mobile_number) }}">
    <x-error name="mobile_number" />
</x-form-field-horizontal>

<x-form-field-horizontal for="emailInput" label="Email" label-class="form-label-optional">
    <input id="emailInput" type="email" class="form-control" name="email" value="{{ old('email', $member->email) }}">
    <x-error name="email" />
</x-form-field-horizontal>

<x-form-field-horizontal for="positionInput" label="Position" label-class="form-label-optional">
    <input id="positionInput" type="text" class="form-control" name="position" value="{{ old('position', $member->position) }}">
    <x-error name="position" />
</x-form-field-horizontal>

<x-form-field-horizontal for="notesTextarea" label="Notes" label-class="form-label-optional">
    <textarea id="notesTextarea" class="form-control" rows="3" name="notes">{{ old('notes', $member->notes) }}</textarea>
    <x-error name="notes" />
</x-form-field-horizontal>

<x-form-field-horizontal for="isCrewMemberSelect" label="Crew member">
    <select id="isCrewMemberSelect" class="form-select" name="is_crew_member">
        <option value="0" {{ isSelected( old('is_crew_member', ($member->is_crew_member ?? 0)) === 0) }}>No, it cannot be in crews.</option>
        <option value="1" {{ isSelected( old('is_crew_member', $member->is_crew_member) === 1) }}>Yes, it can be in crews.</option>
    </select>

    <x-error name="is_crew_member" />
</x-form-field-horizontal>
