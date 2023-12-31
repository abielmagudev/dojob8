@csrf
<x-form-control-horizontal class="align-items-center">
    <x-slot name="label">
        <label for="nameInput" class="form-label">Name</label>
    </x-slot>

    <input id="nameInput" type="text" class="form-control" name="name" value="{{ old('name', $member->name) }}" required>
    <x-error name="name" />
    <x-error name="full_name" />
</x-form-control-horizontal>

<x-form-control-horizontal class="align-items-center">
    <x-slot name="label">
        <label for="lastNameInput" class="form-label">Last name</label>
    </x-slot>

    <input id="lastNameInput" type="text" class="form-control" name="last_name" value="{{ old('last_name', $member->last_name) }}" required>
    <x-error name="last_name" />
    <x-error name="full_name" />
</x-form-control-horizontal>

<x-form-control-horizontal class="align-items-center">
    <x-slot name="label">
        <label for="birthdateInput" class="form-label form-label-optional">Birthdate</label>
    </x-slot>

    <input id="birthdateInput" type="date" class="form-control" name="birthdate" value="{{ old('birthdate', $member->birthdate_input) }}">
    <x-error name="birthdate" />
</x-form-control-horizontal>

<x-form-control-horizontal class="align-items-center">
    <x-slot name="label">
        <label for="phoneNumberInput" class="form-label form-label-optional">Phone</label>
    </x-slot>

    <input id="phoneNumberInput" type="text" class="form-control" name="phone_number" value="{{ old('phone_number', $member->phone_number) }}">
    <x-error name="phone_number" />
</x-form-control-horizontal>

<x-form-control-horizontal class="align-items-center">
    <x-slot name="label">
        <label for="mobileNumberInput" class="form-label form-label-optional">Mobile</label>
    </x-slot>

    <input id="mobileNumberInput" type="text" class="form-control" name="mobile_number" value="{{ old('mobile_number', $member->mobile_number) }}">
    <x-error name="mobile_number" />
</x-form-control-horizontal>

<x-form-control-horizontal class="align-items-center">
    <x-slot name="label">
        <label for="emailInput" class="form-label form-label-optional">Email</label>
    </x-slot>

    <input id="emailInput" type="email" class="form-control" name="email" value="{{ old('email', $member->email) }}">
    <x-error name="email" />
</x-form-control-horizontal>

<x-form-control-horizontal class="align-items-center">
    <x-slot name="label">
        <label for="positionInput" class="form-label form-label-optional">Position</label>
    </x-slot>

    <input id="positionInput" type="text" class="form-control" name="position" value="{{ old('position', $member->position) }}">
    <x-error name="position" />
</x-form-control-horizontal>

<x-form-control-horizontal>
    <x-slot name="label">
        <label for="notesTextarea" class="form-label form-label-optional">Notes</label>
    </x-slot>

    <textarea id="notesTextarea" class="form-control" rows="3" name="notes">{{ old('notes', $member->notes) }}</textarea>
    <x-error name="notes" />
</x-form-control-horizontal>

<x-form-control-horizontal class="align-items-center">
    <x-slot name="label">
        <label for="recruitmentInput" class="form-label">Can it be in crews?</label>
    </x-slot>

    <div class="form-control">
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" id="radioCannotBeInCrews" name="can_be_in_crews" value="0" {{ isChecked( old('can_be_in_crews', ($member->can_be_in_crews ?? 0)) === 0) }}>
            <label class="form-check-label" for="radioCannotBeInCrews">No, it cannot be in crews.</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" id="radioCanBeInCrews" name="can_be_in_crews" value="1" {{ isChecked( old('can_be_in_crews', $member->can_be_in_crews) === 1) }}>
            <label class="form-check-label" for="radioCanBeInCrews">Yes, it can be in crews.</label>
        </div>
    </div>
    <x-error name="can_be_in_crews" />
</x-form-control-horizontal>

@if( $member->id <> null ) 
<br>
<div class="mb-3">
    <div class="form-check form-switch">
        <input class="form-check-input" id="isActiveSwitch" type="checkbox" role="switch" name="is_active" value="1" {{ isChecked( old('is_active', $member->is_active) == 1 ) }}>
        <label class="form-check-label" for="isActiveSwitch"><b>Active.</b> If deactivated, it will not be able to be used in new orders, it will be removed from your crew and your user account will be deactivated.</label>
    </div>
    <x-error name="is_active" />
</div>
@endif
