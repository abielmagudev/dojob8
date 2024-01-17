<x-tooltip title="On hold inspections">
    <a href="{{ urlGeneratorInspection('onHold', $parameters ?? []) }}" class="{{ $class ?? 'btn btn-primary btn-sm' }}">
        {{ $counter }}
    </a>
</x-tooltip>
