<x-modal id="modalMembersFilters" title="Member filters" header-close footer-close>
    <form action="{{ route('members.index') }}" method="get" autocomplete="off" id="formMemberFilters">

        <div class="mb-3">
            <label for="statusSelect" class="form-label">Status</label>
            <select id="statusSelect" name="status" class="form-select">
                <option label="Any status" selected></option>
                <option value="1" {{ isSelected( $request->get('status') === "1" ) }}>Active</option>
                <option value="0" {{ isSelected( $request->get('status') === "0" ) }}>Inactive</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="canBeInCrewsSelect" class="form-label">Can be in crews?</label>
            <select id="canBeInCrewsSelect" name="can_be_in_crews" class="form-select">
                <option label="Any option"></option>
                <option value="1" {{ isSelected( $request->get('can_be_in_crews') === "1" ) }}>Yes, it can be in crews</option>
                <option value="0" {{ isSelected( $request->get('can_be_in_crews') === "0" ) }}>No, it cannot be in crews</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="sortPropSelect" class="form-label">Sort by</label>
            <select id="sortPropSelect" name="sort_prop" class="form-select mb-2">
                <option label="Any option" selected></option>
                <option value="name" {{ isSelected( $request->get('sort_prop') == 'name' ) }}>Name</option>
                <option value="last_name" {{ isSelected( $request->get('sort_prop') == 'last_name' ) }}>Last name</option>
            </select>
            <select id="sortPropWaySelect" name="sort_prop_way" class="form-select">
                <option value="asc" {{ isSelected( $request->get('sort_prop_way') == 'asc' ) }}>Descending</option>
                <option value="desc" {{ isSelected( $request->get('sort_prop_way') == 'desc' ) }}>Ascending</option>
            </select>
        </div>

        @include('components.form.filters.sort')
    </form>

    @slot('footer')
    <button class="btn btn-success" type="submit" form="formMemberFilters">Set filters on members</button>
    @endslot
</x-modal>
