<x-card title="Work order #{{ $inspection->work_order->id }}" class="h-100">
    @slot('options')
    <a href="{{ route('work-orders.show', $inspection->work_order) }}" class="btn btn-primary">
        <i class="bi bi-eye-fill"></i>
    </a>
    @endslot

    <p>
        @include('work-orders.__.status-flag', ['status' => $inspection->work_order->status])
    </p>
    
    <x-small-title title="Scheduled">
        {{ $inspection->work_order->scheduled_date_human }}
    </x-small-title>

    <x-small-title title="Job">
        {{ $inspection->work_order->job->name }}
    </x-small-title>
    
    <x-small-title title="Client">
        @include('clients.__.address', ['client' => $inspection->work_order->client])
    </x-small-title>

    <x-small-title title="Notes">
        {{ $inspection->work_order->notes }}
    </x-small-title>
</x-card>
