<div>
    <span>{{ $work_order->job->name }}</span>
    @if( $work_order->isNonstandard() )
    <div class="text-capitalize text-secondary">
        <em class="small">{{ $work_order->type }}: {{ $work_order->type_id }}</em>
    </div>
    @endif
</div>
