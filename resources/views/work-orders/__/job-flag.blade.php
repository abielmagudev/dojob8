<div>
    <span>{{ $work_order->job->name }}</span>
    @if( $work_order->isNonstandard() )
    <em class="text-capitalize text-secondary small">({{ $work_order->type }}: {{ $work_order->type_id }})</em>
    @endif
</div>
