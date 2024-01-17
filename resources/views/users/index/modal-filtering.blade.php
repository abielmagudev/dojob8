<x-modal id="modalFilterUsers" title="User filters" header-close footer-close>

    <form action="{{ route('users.index') }}" method="GET" autocomplete="off" id="formUserFilters">
        @include('users.index.modal-filters.status')
        @include('users.index.modal-filters.profile')
        @include('components.custom.select-sort')
        <br>
    </form>
    
    @slot('footer')
    <button type="submit" class="btn btn-success" form="formUserFilters" name="fltr" value="on">Set filters on Users</button>
    @endslot

</x-modal>
