<x-modal id="historyFilterModal" title="History filters" footer-close>

    <form action="{{ route('history.index') }}" method="get" autocomplete="off" id="formFilterHistory">
        @include('components.form.filters.from-to-dates')
        @include('history.index.modal-filters.topic')
        @include('history.index.modal-filters.user')
        @include('components.form.filters.sort')
    </form>
    
    <x-slot name="footer">
        <button class="btn btn-success" type="submit" form="formFilterHistory">Set filters on History</button>
    </x-slot>
</x-modal>
