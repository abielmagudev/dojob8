<x-modal id="modalInspectionFilters" title="Inspection filters" header-close footer-close>
    <form action="{{ route('inspections.index') }}" method="get" autocomplete="off" id="formInspectionFilters">
        
        @include('inspections.index.modal-inspection-filters.scheduled-date-range')
        @include('inspections.index.modal-inspection-filters.statuses')
        @include('inspections.index.modal-inspection-filters.inspectors')
        @include('inspections.index.modal-inspection-filters.sort')

    </form>

    @slot('footer')
    <button class="btn btn-success" type="submit" form="formInspectionFilters">Set filters</button>
    @endslot
</x-modal>
