<x-card class="h-100" title="Job">
    <x-custom.p-label label="Status">
        <x-custom.badge-status>{{ $order->status ?? 'Done' }}</x-custom.badge-status>
    </x-custom.p-label>

    <x-custom.p-label label="Name">
        <span class="d-block">{{ $order->job->name }}</span>
        <small>{{ $order->job->description }}</small>
    </x-custom.p-label>

    @if( $order->job->hasExtensions() )
    <x-custom.p-label label="Extensions">
        @foreach($order->job->extensions as $extension)
        <div>{{ $extension->name }}</div>
        @endforeach
    </x-custom.p-label>
    @endif

    <x-custom.p-label label="Approved inspections required">
        {{ $order->job->successful_inspections }}
    </x-custom.p-label>

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
