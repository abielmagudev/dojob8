<x-modal id="modalInspectionFilters" title="Inspection filters" header-close footer-close>
    <form action="{{ route('inspections.index') }}" method="get" autocomplete="off" id="formInspectionFilters">
        
        @include('components.custom.input-between-dates')
        @include('inspections.index.modal-filters.inspectors')
        @include('inspections.index.modal-filters.crews')
        @include('inspections.index.modal-filters.statuses')
        @include('components.custom.select-sort')

    </form>

    @slot('footer')
    <button class="btn btn-success" type="submit" form="formInspectionFilters">Set filters on Inspections</button>
    @endslot
</x-modal>
