<div class="row">
    <div class="col-sm mb-3 mb-md-0">
        <x-card class="text-center">
            <span class="d-block text-uppercase small">Year</span>
            <span class="fs-3">{{ $work_orders->count() }}</span>
        </x-card>
    </div>
    <div class="col-sm mb-3 mb-md-0">
        <x-card class="text-center">
            <span class="d-block text-uppercase small">Month</span>
            @if( $work_orders->count()  )
            <span class="fs-3">{{ $work_orders->filter(function ($work_order) {
                return $work_order->scheduled_date->month == date('m');
            })->count() }}</span>
                
            @else
            <span class="fs-3">0</span>

            @endif
        </x-card>
    </div>
    <div class="col-sm mb-3 mb-md-0">
        <x-card class="text-center">
            <span class="d-block text-uppercase small">Today</span>
            @if( $work_orders->count() )
            <span class="fs-3">{{ $work_orders->filter(function ($work_order) {
                return $work_order->scheduled_date_input == date('Y-m-d');
            })->count() }}</span>
                
            @else
            <span class="fs-3">0</span>
                
            @endif
        </x-card>
    </div>
    <div class="col-sm mb-3 mb-md-0">
        <x-card class="text-center">
            <span class="d-block text-uppercase small">Unfinished until today</span>
            <span class="fs-3">{{ $unfinished_work_orders->count() }}</span>
        </x-card>
    </div>
</div>
