<x-card>
    <x-slot name="title">
        <x-custom.indicator-active-status :toggle="$job->isActive()" />
    </x-slot>

    <x-slot name="options">
        @if( $job->hasWorkOrdersWithIncompleteStatus() )                  
        @include('work-orders.__.button-counter-incomplete', [
            'class' => 'btn btn-outline-warning',
            'counter' => $job->onlyIncompleteWorkOrders()->count(),
            'parameters' => ['job' => $job->id],
        ])
        @endif

        @include('work-orders.__.button-counter-all', [
            'class' => 'btn btn-outline-primary',
            'counter' => $job->work_orders->count(),
            'parameters' => ['job' => $job->id],
        ])
        
        <a href="{{ route('jobs.edit', $job) }}" class="btn btn-warning">
            <i class="bi bi-pencil-fill"></i>
        </a>
    </x-slot>

    <x-small-title title="Description">
        {{ $job->description }}
    </x-small-title>

    <x-small-title title="Approved inspections required">
        {{ $job->approved_inspections_required_count }}
    </x-small-title>

    <x-small-title title="Agencies to generate inspections">
    @if( $job->hasAgenciesToGenerateInspections() )           
        @foreach($job->agenciesToGenerateInspections() as $agency)
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
