<x-modal id="modalWorkOrdersFilter" title="Filter work orders" dialog-class="modal-dialog-scrollable" header-close footer-close>
    <form action="{{ route('work-orders.index') }}" method="get" autocomplete="off" id="formWorkOrdersFilter">
        @include('work-orders.index.modal-work-orders-filter.scheduled-date-ranges')
        @include('work-orders.index.modal-work-orders-filter.status-rule')
        @include('work-orders.index.modal-work-orders-filter.job')
        @include('work-orders.index.modal-work-orders-filter.crew')
        @include('work-orders.index.modal-work-orders-filter.intermediary')
        @include('work-orders.index.modal-work-orders-filter.sort')
    </form>
    
    @slot('footer')
    <button class="btn btn-success" form="formWorkOrdersFilter">Set filters</button>
    @endslot
</x-modal>
