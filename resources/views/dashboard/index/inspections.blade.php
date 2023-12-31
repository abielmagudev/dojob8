<x-card title="Inspections">
    <div class="row text-center">
        <div class="col-sm mb-3 mb-md-0">
            <span class="fs-3">{{ $inspections->count() }}</span>
            <span class="d-block text-uppercase small">Total</span>
        </div>
        <div class="col-sm mb-3 mb-md-0">
            <span class="fs-3">{{ $inspections->filter(fn($inspection) => $inspection->hasStatus('pending'))->count() }}</span>
            <span class="d-block text-uppercase small">Pending</span>
        </div>
        <div class="col-sm mb-3 mb-md-0">
            <span class="fs-3">{{ $inspections->filter(fn($inspection) => $inspection->hasStatus('on hold'))->count() }}</span>
            <span class="d-block text-uppercase small">On hold</span>
        </div>
        <div class="col-sm mb-3 mb-md-0">
            <span class="fs-3">{{ $inspections->filter(fn($inspection) => $inspection->hasStatus('passed'))->count() }}</span>
            <span class="d-block text-uppercase small">Passed</span>
        </div>
        <div class="col-sm mb-3 mb-md-0">
            <span class="fs-3">{{ $inspections->filter(fn($inspection) => $inspection->hasStatus('failed'))->count() }}</span>
            <span class="d-block text-uppercase small">Failed</span>
        </div>
    </div>
</x-card>
