<h6 class="text-secondary">Summary</h6>
<div class="alert border rounded mb-3">
    <div class="row">
        <div class="col-sm"/>
            <x-small-title title="Job">
                <b>{{ $work_order->job->name }}</b>
                <br>
                <small>{{ $work_order->job->description }}</small>
            </x-small-title>
        </div>
    
        <div class="col-sm">
            <x-small-title title="Notes">
                {{ $work_order->notes ?? 'None' }}
            </x-small-title>
        </div>
    
        <div class="col-sm">
            <x-small-title title="Success inspections required">
                {{ $work_order->job->requiresSuccessInspections() ? $work_order->job->success_inspections_required_count : 0 }}
            </x-small-title>
        </div>
    </div>
</div>
