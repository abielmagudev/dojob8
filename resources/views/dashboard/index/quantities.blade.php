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
            <span class="fs-3">{{ $work_orders->filter(function ($work_order) {
                return $work_order->scheduled_date->month == date('m');
            })->count() }}</span>
        </x-card>
    </div>
    <div class="col-sm mb-3 mb-md-0">
        <x-card class="text-center">
            <span class="d-block text-uppercase small">Today</span>
            <span class="fs-3">{{ $work_orders->filter(function ($work_order) {
                return $work_order->scheduled_date->day == date('d');
            })->count() }}</span>
        </x-card>
    </div>
</div>
