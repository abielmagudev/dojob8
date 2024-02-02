<x-tooltip title="On hold inspections">
    <a href="{{ App\Models\Inspection\InspectionUrlGenerator::onHold($parameters ?? []) }}" class="{{ $class ?? 'btn btn-primary btn-sm' }}">
        {{ $counter }}
    </a>
</x-tooltip>
