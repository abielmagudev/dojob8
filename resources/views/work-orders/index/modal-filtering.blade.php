<!-- Trigger -->
<x-modal-trigger modal-id="modalWorkOrdersFilter" class="dropdown-item">
    <i class="bi bi-filter"></i>
    <span class="ms-1">More filters</span>
</x-modal-trigger>

<!-- Modal -->
@push('end')
<x-modal id="modalWorkOrdersFilter" title="Work order filters" dialog-class="modal-dialog-scrollable" header-close>
    <form action="{{ route('work-orders.index') }}" method="get" autocomplete="off" id="formWorkOrderFilters">
        @include('components.custom.input-between-dates')
        @include('work-orders.index.modal-filtering.type')
        @include('work-orders.index.modal-filtering.status')
        @include('components.custom.select-pending')
        @include('work-orders.index.modal-filtering.job')
        @include('work-orders.index.modal-filtering.crew')
        @include('work-orders.index.modal-filtering.contractor')
        @include('work-orders.index.modal-filtering.sort')
    </form>
    
    @slot('footer')
    <x-modal-button-close>Cancel</x-modal-button-close>
    <button class="btn btn-success" form="formWorkOrderFilters">Set filters on work orders</button>
    @endslot
</x-modal>
@endpush
