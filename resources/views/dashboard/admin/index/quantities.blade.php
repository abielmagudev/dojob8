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
            @if( $work_orders->count() )
            <span class="fs-3">{{ $work_orders->filter(function ($wo) {
                return $wo->scheduled_date->month == date('m');
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
            <span class="fs-3">{{ $work_orders->filter(function ($wo) {
                return $wo->scheduled_date_input == date('Y-m-d');
            })->count() }}</span>
                
            @else
            <span class="fs-3">0</span>
                
            @endif
        </x-card>
    </div>
    <div class="col-sm mb-3 mb-md-0">
        <x-card class="text-center">
            <span class="d-block text-uppercase small">Incomplete until today</span>
            <span class="fs-3">{{ $work_orders->filter(function ($wo) {
                return $wo->hasIncompleteStatus();
            })->count() }}</span>
        </x-card>
    </div>
</div>
