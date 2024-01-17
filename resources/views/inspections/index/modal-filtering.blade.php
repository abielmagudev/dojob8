<x-modal id="modalInspectionFilters" title="Inspection filters" header-close footer-close>
    <form action="{{ route('inspections.index') }}" method="get" autocomplete="off" id="formInspectionFilters">
        
        @include('components.custom.input-between-dates')
        @include('inspections.index.modal-filters.inspector')
        @include('inspections.index.modal-filters.crew')
        @include('inspections.index.modal-filters.status-group')
        @include('components.custom.select-sort')

    </form>

    @slot('footer')
    <button class="btn btn-success" type="submit" form="formInspectionFilters" name="fltr" value="on">Set filters on Inspections</button>
    @endslot
</x-modal>
