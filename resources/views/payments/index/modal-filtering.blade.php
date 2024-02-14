<x-modal id="modalFiltering" title="Payment filters" header-close>
    <form action="{{ route('payments.index') }}" method="get" id="formFiltering">
        @include('components.custom.input-between-dates')
        @include('payments.index.modal-filters.status')
        @include('work-orders.index.modal-filters.contractor')
        @include('work-orders.index.modal-filters.job')
        @include('components.custom.select-sort')
    </form>
    
    <x-slot name="footer">
        <x-modal-button-close>Cancel</x-modal-button-close>
        <button class="btn btn-success" type="submit" form="formFiltering">Set filters on Payments</button>
    </x-slot>
</x-modal>
