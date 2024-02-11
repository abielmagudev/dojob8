<x-tooltip title="Awaiting inspections" class="d-inline-block">
    <a href="{{ App\Http\Controllers\InspectionController\InspectionUrlGenerator::awaiting($parameters ?? []) }}" class="{{ $class ?? 'btn btn-primary btn-sm' }}">
        {{ $counter }}
    </a>
</x-tooltip>
