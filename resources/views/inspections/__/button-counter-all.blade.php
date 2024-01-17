<x-tooltip title="All inspections">
    <a href="{{ urlGeneratorInspection('all', $parameters ?? []) }}" class="{{ $class ?? 'btn btn-primary btn-sm' }}">
        {{ $counter }}
    </a>
</x-tooltip>
