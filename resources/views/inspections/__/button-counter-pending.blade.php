<x-tooltip title="Pending inspections">
    <a href="{{ App\Models\Inspection\InspectionUrlGenerator::pending($parameters ?? []) }}" class="{{ $class ?? 'btn btn-warning btn-sm' }}">
        {{ $counter }}
    </a>
</x-tooltip>
