<x-card class="h-100" title="Job">    
    <small class="text-secondary">Name</small>
    <p class="mb-0">
        <b>{{ $order->job->name }}</b>
    </p>
    <p>
        <small>{{ $order->job->description }}</small>
    </p>
    
    <small class="text-secondary">Status</small>
    <p>
        <span class="badge text-bg-warning">Started</span>
    </p>

    <small class="text-secondary">Created by</small>
    <p>Username | {{ now() }}</p>

    <small class="text-secondary">Updated by</small>
    <p>Username | {{ now() }}</p>

    @if( $order->job->hasExtensions() )
    <small class="text-secondary">Extensions</small>

    @foreach($order->job->extensions as $extension)
    <div>{{ $extension->name }}</div>
    @endforeach

    @endif
</x-card>
