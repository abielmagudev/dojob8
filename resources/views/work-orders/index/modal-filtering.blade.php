<x-modal id="modalWorkOrdersFilter" title="Work order filters" dialog-class="modal-dialog-scrollable" header-close footer-close>
    
    <form action="{{ route('work-orders.index') }}" method="get" autocomplete="off" id="formWorkOrderFilters">
        @include('components.custom.input-between-dates')
        @include('work-orders.index.modal-filters.statuses-rule')
        @include('work-orders.index.modal-filters.job')
        @include('work-orders.index.modal-filters.crew')
        @include('work-orders.index.modal-filters.contractor')
        @include('work-orders.index.modal-filters.sort')
    </form>
    
    @slot('footer')
    <button class="btn btn-success" form="formWorkOrderFilters" name="fltr" value="on">Set filters on Work orders</button>
    @endslot
</x-modal>
