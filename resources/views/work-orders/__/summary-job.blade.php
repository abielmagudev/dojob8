<div>
    <span>{{ $work_order->job->name }}</span>
    @if( $work_order->isRectification() )
    <div class="text-capitalize text-secondary">
        <em class="small">{{ $work_order->type }}:</em>
        <a class="small text-decoration-none" href="{{ route('work-orders.show', $work_order->rectification_id) }}">{{ $work_order->rectification_id }}</a>
    </div>
    @endif
</div>
