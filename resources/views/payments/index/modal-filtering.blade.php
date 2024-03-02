<x-modal id="modalFiltering" title="Payment filters" header-close>
    <form action="{{ route('payments.index') }}" method="get" id="formFiltering">
        @include('components.custom.input-between-dates')
        @include('payments.index.modal-filtering.status')
        @include('work-orders.index.modals.modal-filtering.contractor')
        @include('work-orders.index.modals.modal-filtering.job')
        @include('components.custom.select-sort')
    </form>
    
    <x-slot name="footer">
        <x-modal-button-close>Cancel</x-modal-button-close>
        <button class="btn btn-success" type="submit" form="formFiltering">Set filters on payments</button>
    </x-slot>
</x-modal>
