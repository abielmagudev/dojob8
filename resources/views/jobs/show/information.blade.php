<x-card title="Information">
    <x-slot name="options">
        <a href="{{ route('jobs.edit', $job) }}" class="btn btn-warning">
            <i class="bi bi-pencil-fill"></i>
        </a>
    </x-slot>

    <p>
        <x-indicator-on-off :toggle="$job->isActive()" />
        <span>{{ ucfirst($job->presence_status) }}</span>
    </p>

    <x-small-title title="Description">
        {{ $job->description }}
    </x-small-title>

    <x-small-title title="Successful inspections required">
        {{ $job->successful_inspections_required }}
    </x-small-title>

    <x-small-title title="Preconfigured inspections required">
    @if( $job->hasPreconfiguredRequiredInspections() )           
        @foreach($job->inspectors_preconfigured as $inspector)
        <span class="badge border">
            <a href="{{ route('inspectors.show', $inspector) }}" class="text-decoration-none">{{ $inspector->name }}</a>
        </span>
        @endforeach

    @else
        <span>No</span>
    @endif
    </x-small-title>
    
    <x-custom.information-hook-users :model="$job" />
</x-card>
