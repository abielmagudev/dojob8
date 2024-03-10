<x-card>
    @slot('title')
    
    @include('work-orders.__.flag-status', [
        'status' => $work_order->status,
        'display' => 'd-inline-block',
    ])
    
    @if($work_order->payment)      
    @includeWhen(auth()->user()->can('see-payments'),'payments.__.flag-status', [
        'status' => $work_order->payment->status
    ])
    @endif

    @endslot

    @can('edit-work-orders')      
    @slot('options')
    <a href="{{ route('work-orders.edit', $work_order) }}" class="btn btn-warning ms-3">
        <i class="bi bi-pencil-fill"></i>
    </a>
    @endslot
    @endcan

    @include('work-orders.show.information.job')
    @includeWhen($work_order->job->hasExtensions(), 'work-orders.show.information.extensions')
    @include('work-orders.show.information.timeline')
    @include('work-orders.show.information.participants')
</x-card>
