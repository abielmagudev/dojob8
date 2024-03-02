<x-modal-trigger modal-id="modalFiltering" class="dropdown-item" link>
    <i class="bi bi-filter"></i>
    <span class="ms-1">More filters</span>
</x-modal-trigger>

@push('end')
<x-modal id="modalFiltering" title="Inspection filters" header-close>
    <form action="{{ route('inspections.index') }}" method="get" autocomplete="off" id="formFiltering"> 
        @include('components.custom.input-between-dates')
        @include('components.custom.select-pending')
        @include('inspections.index.modal-filtering.agency')
        @include('inspections.index.modal-filtering.crew')
        @include('inspections.index.modal-filtering.status-group')
        @include('components.custom.select-sort')
    </form>

    @slot('footer')
        <x-modal-button-close>Close</x-modal-button-close>
        <button class="btn btn-success" type="submit" form="formFiltering">Set filters on Inspections</button>
    @endslot
</x-modal>  
@endpush
