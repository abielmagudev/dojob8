<x-tooltip title="All inspections" class="d-inline-block">
    <a href="{{ App\Http\Controllers\InspectionController\InspectionUrlGenerator::all($parameters ?? []) }}" class="{{ $class ?? 'btn btn-primary btn-sm' }}">
        {{ $counter }}
    </a>
</x-tooltip>
