<x-card title="Information" class="h-100">  
    @slot('options')
    <a href="{{ route('inspections.edit', $inspection) }}" class="btn btn-warning">
        <i class="bi bi-pencil-fill"></i>
    </a>
    @endslot
    
    <p>
        @include('inspections.__.status-flag', [
            'status' => $inspection->status,
        ])
    </p>      

    <x-small-title title="Scheduled">
        {{ $inspection->scheduled_date_human }}
    </x-small-title>

    <x-small-title title="Inspector">
        {{ $inspection->inspector->name }}
    </x-small-title>

    <x-small-title title="Crew">
        {{ $inspection->hasCrew() ? $inspection->crew->name : '' }}
    </x-small-title>

    <x-small-title title="Observations">
        {{ $inspection->observations }}
    </x-small-title>

    <x-custom.information-hook-users :model="$inspection" />
</x-card>
