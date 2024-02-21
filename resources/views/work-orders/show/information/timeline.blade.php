<div class="alert border rounded">
    <h6 class="text-secondary">Timeline</h6>
    <div class="row">
        <div class="col-sm">
            <x-small-title title="Schedule">
                {{ $work_order->scheduled_date_human }}
            </x-small-title>
        </div>

        <div class="col-sm">
            <x-small-title title="Working">
                {{ $work_order->working_at }}
            </x-small-title>
        </div>

        <div class="col-sm">
            <x-small-title title="Done">
                {{ $work_order->done_at }}
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