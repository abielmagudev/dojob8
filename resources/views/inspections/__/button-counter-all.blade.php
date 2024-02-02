<x-tooltip title="All inspections">
    <a href="{{ App\Models\Inspection\InspectionUrlGenerator::all($parameters ?? []) }}" class="{{ $class ?? 'btn btn-primary btn-sm' }}">
        {{ $counter }}
    </a>
</x-tooltip>
