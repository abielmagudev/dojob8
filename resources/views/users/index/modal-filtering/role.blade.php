<div class="mb-3">
    <label for="roleSelect" class="form-label">Role</label>
    <select id="roleSelect" name="role" class="form-select">
        <option label="* Any role" selected></option>
        @foreach($roles as $role)
        <option value="{{ $role }}" {{ isSelected( $request->get('role') === $role) }}>{{ ucwords($role) }}</option>
        @endforeach
    </select>
</div>
