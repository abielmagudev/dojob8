<x-tooltip title="On hold inspections">
    <a href="{{ App\Http\Controllers\InspectionController\InspectionUrlGenerator::onHold($parameters ?? []) }}" class="{{ $class ?? 'btn btn-primary btn-sm' }}">
        {{ $counter }}
    </a>
</x-tooltip>
