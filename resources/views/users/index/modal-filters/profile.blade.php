<div class="mb-3">
    <label for="profileSelect" class="form-label">Profile</label>
    <select id="profileSelect" name="profile" class="form-select">
        <option label="Any profile" selected></option>
        @foreach(\App\Models\User\UserProfiler::getAliases() as $alias)
        <option value="{{ $alias }}" {{ isSelected( $request->get('profile') === $alias) }}>{{ ucwords($alias) }}</option>
        @endforeach
    </select>
</div>
