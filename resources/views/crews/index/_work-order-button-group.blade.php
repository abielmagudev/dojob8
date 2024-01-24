@if( $crew->hasIncompleteWorkOrders() )
<a href="{{ urlGeneratorWorkOrders('incomplete', ['crew' => $crew->id]) }}" class="btn {{ $show == 'grid' ? 'btn-outline-warning' : 'btn-warning' }} btn-sm" data-bs-toggle="tooltip" data-bs-title="Incomplete work orders">{{ $crew->incomplete_work_orders_count }}</a>
@endif

@if( $crew->hasWorkOrders() )
<a href="{{ urlGeneratorWorkOrders('all', ['crew' => $crew->id]) }}" class="btn {{ $show == 'grid' ? 'btn-outline-primary' : 'btn-primary' }} btn-sm" data-bs-toggle="tooltip" data-bs-title="Work orders">{{ $crew->work_orders->count() }}</a>
@endif
