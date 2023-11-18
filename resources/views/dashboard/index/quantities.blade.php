<div class="row">
    <div class="col-sm mb-3 mb-md-0">
        <x-card class="text-center">
            <span class="d-block text-uppercase small">Year</span>
            <span class="fs-3">{{ $orders->count() }}</span>
        </x-card>
    </div>
    <div class="col-sm mb-3 mb-md-0">
        <x-card class="text-center">
            <span class="d-block text-uppercase small">Month</span>
            <span class="fs-3">{{ $orders->filter(function ($order) {
                return $order->scheduled_date->month == date('m');
            })->count() }}</span>
        </x-card>
    </div>
    <div class="col-sm mb-3 mb-md-0">
        <x-card class="text-center">
            <spa class="d-block text-uppercase small">Today</spa>
            <span class="fs-3">{{ $orders->filter(function ($order) {
                return $order->scheduled_date->day == date('d');
            })->count() }}</span>
        </x-card>
    </div>
</div>
