<x-card>
    <x-slot name="custom_title">
        <x-custom.indicator-active-status :toggle="$job->isActive()" />
    </x-slot>

    <x-slot name="options">
        <a href="{{ route('jobs.edit', $job) }}" class="btn btn-warning">
            <i class="bi bi-pencil-fill"></i>
        </a>
    </x-slot>

    <x-small-title title="Description">
        {{ $job->description }}
    </x-small-title>

    <x-small-title title="Successful inspections required">
        {{ $job->successful_inspections_required }}
    </x-small-title>

    <x-small-title title="Preconfigured inspections required">
    @if( $job->hasPreconfiguredRequiredInspections() )           
        @foreach($job->inspectors_preconfigured as $agency)
        <span class="badge border">
            <a href="{{ route('agencies.show', $agency) }}" class="text-decoration-none">{{ $agency->name }}</a>
        </span>
        @endforeach

    @else
        <span>No</span>
    @endif
    </x-small-title>
    
    <x-custom.information-hook-users :model="$job" />
</x-card>
