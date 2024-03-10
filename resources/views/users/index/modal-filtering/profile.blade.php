<div class="mb-3">
    <label for="profileSelect" class="form-label">Profile</label>
    <select id="profileSelect" name="profile" class="form-select">
        <option label="* Any profile" selected></option>
        @foreach($profiles as $profile)
        <option value="{{ $profile }}" {{ isSelected( $request->get('profile') === $profile) }}>{{ ucwords($profile) }}</option>
        @endforeach
    </select>
</div>
