<div class="mb-3">
    <label for="userSelect" class="form-label">User</label>
    <select id="userSelect" class="form-select" name="user">
        <option selected label="- Any user -"></option>
        
        @foreach($users as $user)
        <option value="{{ $user->id }}" {{ isSelected($user->id == $request->get('user')) }}>{{ ucfirst($user->name) }} {{ $user->deleted_at ? '(Deleted)' : '' }}</option>
        @endforeach
    </select>
</div>
