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
        @includeWhen(auth()->user()->hasAdminRole(), 'work-orders.index.modals.modal-filtering.type')
        @include('work-orders.index.modals.modal-filtering.status')
        @includeWhen(auth()->user()->hasAdminRole() || auth()->user()->hasRole('assessor'), 'components.custom.select-pending')
        @include('work-orders.index.modals.modal-filtering.job')
        @include('work-orders.index.modals.modal-filtering.crew')
        @include('work-orders.index.modals.modal-filtering.contractor')
        @include('work-orders.index.modals.modal-filtering.sort')
    </form>
    
    @slot('footer')
    <x-modal-button-close>Cancel</x-modal-button-close>
    <button class="btn btn-success" form="formWorkOrderFilters">Set filters on work orders</button>
    @endslot
</x-modal>
@endpush
