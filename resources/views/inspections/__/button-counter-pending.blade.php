<x-tooltip title="Pending inspections">
    <a href="{{ App\Http\Controllers\InspectionController\InspectionUrlGenerator::pending($parameters ?? []) }}" class="{{ $class ?? 'btn btn-warning btn-sm' }}">
        {{ $counter }}
    </a>
</x-tooltip>
