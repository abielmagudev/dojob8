<x-form-field-horizontal for="memberRoleSelect" label="Member role" class="mb-4">
    <select name="member_role" id="memberRoleSelect" class="form-select">
        @foreach($member_roles->reverse() as $role)             
        <option value="{{ $role }}" {{ isSelected( $role == old('member_role', $user->roles()->first()->name ?? false) ) }}>{{ ucfirst($role) }} {{ $role == 'SuperAdmin' ? '- WARNING!' : '' }}</option>
        @endforeach
    </select>
    <x-form-feedback error="member_role" />
</x-form-field-horizontal>
