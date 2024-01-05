<x-modal id="modalInspectionFilters" title="Inspection filters" header-close footer-close>
    <form action="{{ route('inspections.index') }}" method="get" autocomplete="off" id="formInspectionFilters">
        
        @include('components.form.filters.between-dates')
        @include('inspections.index.modal-inspection-filters.inspectors')
        @include('inspections.index.modal-inspection-filters.crews')
        @include('inspections.index.modal-inspection-filters.statuses')
        @include('components.form.filters.sort')

    </form>

    @slot('footer')
    <button class="btn btn-success" type="submit" form="formInspectionFilters">Set filters on Inspections</button>
    @endslot
</x-modal>
