
<x-card class="h-100" title="Information">
    <x-custom.p-label label="Status">
        <x-custom.badge-status>{{ $order->status ?? 'Done' }}</x-custom.badge-status>
    </x-custom.p-label>
    
    <x-custom.p-label label="Job">
        <span class="d-block">{{ $order->job->name }}</span>
        <small>{{ $order->job->description }}</small>
    </x-custom.p-label>

    <x-custom.p-label label="Approved inspections required">
        {{ $order->job->approved_inspections_required }}
    </x-custom.p-label>

    <x-custom.p-label label="Extensions">
        {{ $order->job->hasExtensions() ? 'Yes' : 'No' }}
    </x-custom.p-label>

    @if( $order->job->hasExtensions() )
        @foreach($order->job->extensions as $extension)
        <div>{{ $extension->name }}</div>
        @endforeach
    @endif
    
    <x-custom.p-label label="Notes">
        {{ $order->notes }}
    </x-custom.p-label>

    <x-custom.p-label label="Created by">
        Username, {{ now() }}
    </x-custom.p-label>

    <x-custom.p-label label="Updated by">
        Username, {{ now() }}
    </x-custom.p-label>
</x-card>
