
<x-card class="h-100" title="Information">
    <x-custom.p-label label="Status">
        <x-custom.badge-status>{{ $work_order->status ?? 'Done' }}</x-custom.badge-status>
    </x-custom.p-label>
    
    <x-custom.p-label label="Job">
        <span class="d-block">{{ $work_order->job->name }}</span>
        <small>{{ $work_order->job->description }}</small>
    </x-custom.p-label>

    <x-custom.p-label label="Approved inspections required">
        {{ $work_order->job->approved_inspections_required }}
    </x-custom.p-label>

    <x-custom.p-label label="Extensions">
        {{ $work_order->job->hasExtensions() ? 'Yes' : 'No' }}
    </x-custom.p-label>

    @if( $work_order->job->hasExtensions() )
        @foreach($work_order->job->extensions as $extension)
        <div>{{ $extension->name }}</div>
        @endforeach
    @endif
    
    <x-custom.p-label label="Notes">
        {{ $work_order->notes }}
    </x-custom.p-label>

    <x-custom.p-label label="Created by">
        Username, {{ now() }}
    </x-custom.p-label>

    <x-custom.p-label label="Updated by">
        Username, {{ now() }}
    </x-custom.p-label>
</x-card>
