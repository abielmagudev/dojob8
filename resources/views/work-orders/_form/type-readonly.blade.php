<x-form-field-horizontal label="Type">
    <div class="form-control bg-body-tertiary">
        <option value="{{ $work_order->type }}">{{ title($work_order->type) }}</option>
    </div>

    @if(! $work_order->isDefault() )
    <?php $value = $work_order->isRework() ? "#{$work_order->rework->id} - {$work_order->rework->job->name}" : "#{$work_order->warranty->id} - {$work_order->warranty->job->name}" ?>
    <div class="form-control bg-body-tertiary mt-3">{{ $value }}</div>
    @endif
</x-form-field-horizontal>
