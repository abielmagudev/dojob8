<div class="btn-group {{ $show == 'grid' ? 'btn-group-sm' : '' }}">
    @if( $crew->hasUnfinishedWorkOrders() )
    <a href="{{ workOrderUrlGenerator('unfinished', ['crew' => $crew->id]) }}" class="btn {{ $show == 'grid' ? 'btn-outline-warning' : 'btn-warning' }}" data-bs-toggle="tooltip" data-bs-title="Unfinished work orders">{{ $crew->work_orders_unfinished_count }}</a>
    @endif

    @if( $crew->hasWorkOrders() )
    <a href="{{ workOrderUrlGenerator('all', ['crew' => $crew->id]) }}" class="btn {{ $show == 'grid' ? 'btn-outline-primary' : 'btn-primary' }}" data-bs-toggle="tooltip" data-bs-title="Work orders">{{ $crew->work_orders->count() }}</a>
    @endif
</div>
