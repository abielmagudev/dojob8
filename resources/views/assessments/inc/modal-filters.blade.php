<!-- Trigger -->
<x-modal-trigger modal-id="filtersModal" class="dropdown-item">
    <i class="bi bi-filter"></i>
    <span class="ms-1">More filters</span>
</x-modal-trigger>

@push('end') 
<!-- Modal -->
<x-modal id="filtersModal" title="Assessment filters" dialog-class="modal-dialog-scrollable" header-close>
    <form action="{{ route('assessments.index') }}" method="get" autocomplete="off" id="filtersForm">
        @include('components.custom.input-between-dates')
        @include('assessments.inc.modal-filters.filter-type')
        <x-form.filter-contractor :collection="$contractors" />
        <x-form.filter-crew :collection="$crews" />
        <x-form.filter-sort />
    </form>
    
    @slot('footer')
    <x-modal-button-close>Cancel</x-modal-button-close>
    <button class="btn btn-success" form="filtersForm">Set filters on assessments</button>
    @endslot
    
</x-modal>
@endpush
