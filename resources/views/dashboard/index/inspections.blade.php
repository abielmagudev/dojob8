<x-card title="Inspections">
    <div class="row text-center">
        <div class="col-sm mb-3 mb-md-0">
            <span class="fs-3">{{ $inspections->count() }}</span>
            <span class="d-block text-uppercase small">Total</span>
        </div>
        <div class="col-sm mb-3 mb-md-0">
            <span class="fs-3">{{ $inspections->filter(fn($inspection) => $inspection->isOnHold())->count() }}</span>
            <span class="d-block text-uppercase small">Pending</span>
        </div>
        <div class="col-sm mb-3 mb-md-0">
            <span class="fs-3">{{ $inspections->filter(fn($inspection) => $inspection->isApproved())->count() }}</span>
            <span class="d-block text-uppercase small">Approved</span>
        </div>
        <div class="col-sm mb-3 mb-md-0">
            <span class="fs-3">{{ $inspections->filter(fn($inspection) => $inspection->isFailed())->count() }}</span>
            <span class="d-block text-uppercase small">Failed</span>
        </div>
    </div>
</x-card>
