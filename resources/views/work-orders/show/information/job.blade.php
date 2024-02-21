<h6 class="text-secondary">Summary</h6>
<div class="alert border rounded mb-3">
    <div class="row">
        <div class="col-sm"/>
            <x-small-title title="Job">
                <b>{{ $work_order->job->name }}</b>
                <small>{{ $work_order->job->description }}</small>
            </x-small-title>
        </div>
    
        <div class="col-sm">
            <x-small-title title="Notes">
                {{ $work_order->notes ?? 'None' }}
            </x-small-title>
        </div>
    
        <div class="col-sm">
            <x-small-title title="Has extensions">
                {{ $work_order->job->hasExtensions() ? 'Yes' : 'No' }}
            </x-small-title>
        </div>
    
        <div class="col-sm">
            <x-small-title title="Approved inspections required">
                {{ $work_order->job->requiresApprovedInspections() ? $work_order->job->approved_inspections_required_count : 0 }}
            </x-small-title>
        </div>
    </div>
</div>
