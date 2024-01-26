<div class="{{ $class ?? '' }}">
    <span>{{ $work_order->job->name }}</span>
    @if(! $work_order->isDefault() )
    <em class="text-capitalize text-secondary">( {{ $work_order->type }} )</em>
    @endif
</div>
