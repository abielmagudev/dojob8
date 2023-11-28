@csrf
<x-form-control-horizontal>
    <x-slot name="label">
        <label for="nameInput" class="form-label">Name</label>
    </x-slot>

    <input id="nameInput" type="text" class="form-control" name="name" value="{{ old('name', $member->name) }}" required>
    <x-error name="name" />
    <x-error name="fullname" />
</x-form-control-horizontal>

<x-form-control-horizontal>
    <x-slot name="label">
        <label for="lastnameInput" class="form-label">Lastname</label>
    </x-slot>

    <input id="lastnameInput" type="text" class="form-control" name="lastname" value="{{ old('lastname', $member->lastname) }}" required>
    <x-error name="lastname" />
    <x-error name="fullname" />
</x-form-control-horizontal>

<x-form-control-horizontal>
    <x-slot name="label">
        <label for="birthdateInput" class="form-label form-label-optional">Birthdate</label>
    </x-slot>

    <input id="birthdateInput" type="date" class="form-control" name="birthdate" value="{{ old('birthdate', $member->birthdate_input) }}">
    <x-error name="birthdate" />
</x-form-control-horizontal>

<x-form-control-horizontal>
    <x-slot name="label">
        <label for="phoneNumberInput" class="form-label form-label-optional">Phone</label>
    </x-slot>

    <input id="phoneNumberInput" type="text" class="form-control" name="phone_number" value="{{ old('phone_number', $member->phone_number) }}">
    <x-error name="phone_number" />
</x-form-control-horizontal>

<x-form-control-horizontal>
    <x-slot name="label">
        <label for="mobileNumberInput" class="form-label form-label-optional">Mobile</label>
    </x-slot>

    <input id="mobileNumberInput" type="text" class="form-control" name="mobile_number" value="{{ old('mobile_number', $member->mobile_number) }}">
    <x-error name="mobile_number" />
</x-form-control-horizontal>

<x-form-control-horizontal>
    <x-slot name="label">
        <label for="emailInput" class="form-label form-label-optional">Email</label>
    </x-slot>

    <input id="emailInput" type="email" class="form-control" name="email" value="{{ old('email', $member->email) }}">
    <x-error name="email" />
</x-form-control-horizontal>

<x-form-control-horizontal>
    <x-slot name="label">
        <label for="positionInput" class="form-label form-label-optional">Position</label>
    </x-slot>

    <input id="positionInput" type="text" class="form-control" name="position" value="{{ old('position', $member->position) }}">
    <x-error name="position" />
</x-form-control-horizontal>

<x-form-control-horizontal>
    <x-slot name="label">
        <label for="categorySelect" class="form-label">
            <span>Category</span>
            <x-modal-trigger modal-id="helpCategoriesModal" class="align-middle" link>
                <i class="bi bi-question-circle"></i>
            </x-modal-trigger>
        </label>
    </x-slot>

    <select id="categorySelect" name="category" class="form-select">
        @foreach($categories as $category)
        <option value="{{ $category }}" {{ isSelected( $category == old('category', $member->category) ) }}>{{ ucfirst($category) }}</option>
        @endforeach
    </select>
    <x-error name="category" />
</x-form-control-horizontal>

<x-form-control-horizontal>
    <x-slot name="label">
        <label for="scopeSelect" class="form-label">
            <span>Scope</span>
            <x-modal-trigger modal-id="helpScopesModal" class="align-middle" link>
                <i class="bi bi-question-circle"></i>
            </x-modal-trigger>
        </label>
    </x-slot>

    <select id="scopeSelect" name="scope" class="form-select">
        @foreach($scopes as $scope)
        <option value="{{ $scope }}" {{ isSelected( $scope == old('scope', $member->scope) ) }}>{{ ucfirst($scope) }}</option>
        @endforeach
    </select>
    <x-error name="scope" />
</x-form-control-horizontal>

<x-form-control-horizontal>
    <x-slot name="label">
        <label for="notesTextarea" class="form-label form-label-optional">Notes</label>
    </x-slot>

    <textarea id="notesTextarea" class="form-control" rows="3" name="notes">{{ old('notes', $member->notes) }}</textarea>
    <x-error name="notes" />
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
