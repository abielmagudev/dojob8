<x-modal id="modalWorkOrdersFilter" title="Work order filters" dialog-class="modal-dialog-scrollable" header-close>
    
    <form action="{{ route('work-orders.index') }}" method="get" autocomplete="off" id="formWorkOrderFilters">
        @include('components.custom.input-between-dates')
        @include('work-orders.index.modal-filters.type')
        @include('work-orders.index.modal-filters.status')
        @include('work-orders.index.modal-filters.job')
        @include('work-orders.index.modal-filters.crew')
        @include('work-orders.index.modal-filters.contractor')
        @include('work-orders.index.modal-filters.sort')
    </form>
    
    @slot('footer')
    <x-modal-button-close>Cancel</x-modal-button-close>
    <button class="btn btn-success" form="formWorkOrderFilters" name="fltr" value="on">Set filters on Work orders</button>
    @endslot
</x-modal>
