<x-card class="h-100" title="Information">
    <x-small-label label="Status">
        <x-badge class="{{ $work_order->status_color }} text-uppercase">{{ $work_order->status }}</x-badge>
    </x-small-label>
    
    <x-small-label label="Job">
        <span class="d-block">{{ $work_order->job->name }}</span>
        <small>{{ $work_order->job->description }}</small>
    </x-small-label>

    <x-small-label label="Approved inspections required">
        {{ $work_order->job->approved_inspections_required }}
    </x-small-label>

    <x-small-label label="Extensions">
        {{ $work_order->job->hasExtensions() ? 'Yes' : 'No' }}
    </x-small-label>

    @if( $work_order->job->hasExtensions() )
        @foreach($work_order->job->extensions as $extension)
        <div>{{ $extension->name }}</div>
        @endforeach
    @endif
    
    <x-small-label label="Notes">
        {{ $work_order->notes }}
    </x-small-label>

    <x-custom.small-label-hook-users :model="$work_order" />
</x-card>
