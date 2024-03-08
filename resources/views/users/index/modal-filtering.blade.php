<x-modal id="modalFilterUsers" title="User filters" header-close>
    <form action="{{ route('users.index') }}" method="GET" autocomplete="off" id="formUserFilters">
        @include('users.index.modal-filtering.status')
        @include('users.index.modal-filtering.profile')
        @include('users.index.modal-filtering.role')
        @include('components.custom.select-sort')
        <br>
    </form>
    
    @slot('footer')
    <x-modal-button-close>Cancel</x-modal-button-close>
    <button type="submit" class="btn btn-success" form="formUserFilters" name="fltr" value="on">Set filters on Users</button>
    @endslot
</x-modal>
