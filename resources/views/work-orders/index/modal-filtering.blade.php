<x-modal id="modalWorkOrdersFilter" title="Filter work orders" dialog-class="modal-dialog-scrollable" header-close footer-close>
    
    <form action="{{ route('work-orders.index') }}" method="get" autocomplete="off" id="formWorkOrdersFilter">
        @include('components.custom.input-between-dates')
        @include('work-orders.index.modal-filters.statuses-rule')
        @include('work-orders.index.modal-filters.job')
        @include('work-orders.index.modal-filters.crew')
        @include('work-orders.index.modal-filters.contractor')
        @include('work-orders.index.modal-filters.sort')
    </form>
    
    @slot('footer')
    <button class="btn btn-success" form="formWorkOrdersFilter">Set filters</button>
    @endslot
</x-modal>
