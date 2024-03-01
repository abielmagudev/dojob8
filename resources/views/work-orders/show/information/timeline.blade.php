<h6 class="text-secondary">Timeline</h6>
<div class="alert border rounded mb-3">
    <div class="row">
        <div class="col-sm">
            <x-small-title title="Schedule">
                @if( $work_order->hasScheduledDate() )
                <div>{{ $work_order->scheduled_date_human }}</div>
                <div>{{ $work_order->creator->name }}</div>
                @endif
            </x-small-title>
        </div>

        <div class="col-sm">
            <x-small-title title="Working">
                @if( $work_order->hasWorkingat() )
                <div>{{ $work_order->working_at }}</div>
                <div>{{ $work_order->working_updater->name ?? '?' }}</div>    
                @endif
            </x-small-title>
        </div>

        <div class="col-sm">
            <x-small-title title="Done">
                @if( $work_order->hasDoneAt() )
                <div>{{ $work_order->done_at }}</div>
                <div>{{ $work_order->done_updater->name ?? '?' }}</div>    
                @endif
            </x-small-title>
        </div>

        <div class="col-sm">
            <x-small-title title="Completed">
                {{ $work_order->completed_date_human }}
            </x-small-title>
        </div>

        <div class="col-sm">
            <x-small-title title="Created">
                <span>{{ $work_order->created_at ?? '' }}</span><br>
                <span>{{ $work_order->hasCreator() ? $work_order->creator->name : '' }}</span>
            </x-small-title>
        </div>

        <div class="col-sm">
            <x-small-title title="Updated">
                <span>{{ $work_order->updated_at ?? '' }}</span><br>
                <span>{{ $work_order->hasUpdater() ? $work_order->updater->name : '' }}</span>
            </x-small-title>
        </div>
    </div>
</div>