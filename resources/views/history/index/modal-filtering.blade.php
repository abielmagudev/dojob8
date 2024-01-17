<x-modal id="historyFilterModal" title="History filters" header-close footer-close>

    <form action="{{ route('history.index') }}" method="get" autocomplete="off" id="formFilterHistory">
        @include('components.custom.input-between-dates')
        @include('history.index.modal-filters.topic')
        @include('history.index.modal-filters.user')
        @include('components.custom.select-sort')
    </form>
    
    <x-slot name="footer">
        <button class="btn btn-success" type="submit" form="formFilterHistory" name="fltr" value="on">Set filters on History</button>
    </x-slot>
</x-modal>
