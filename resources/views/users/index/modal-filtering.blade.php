<x-modal id="modalFilterUsers" title="User filters">
    <form action="{{ route('users.index') }}" method="GET" autocomplete="off">
        @include('users.index.modal-filters.status')
        @include('users.index.modal-filters.profile')
        @include('components.custom.select-sort')
        <br>

        <div class="text-end">
            <button type="submit" class="btn btn-success">Set filters on users</button>
            <x-modal-button-close>Close</x-modal-button-close>
        </div>
    </form>
</x-modal>
