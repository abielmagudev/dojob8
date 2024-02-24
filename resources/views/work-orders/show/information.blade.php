<x-card>
    @slot('options')
    <a href="{{ route('work-orders.edit', $work_order) }}" class="btn btn-warning ms-3">
        <i class="bi bi-pencil-fill"></i>
    </a>
    @endslot

    @include('work-orders.show.information.job')
    @includeWhen($work_order->job->hasExtensions(), 'work-orders.show.information.extensions')
    @include('work-orders.show.information.timeline')
    @include('work-orders.show.information.participants')
</x-card>
