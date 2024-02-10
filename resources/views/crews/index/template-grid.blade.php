<div class="row">
    @foreach($active_crews as $crew)
    <div class="col-md col-md-6 col-lg-3 mb-4">

        <x-card class="h-100" style="border-top:0.5rem solid {{ $crew->isActive() ? $crew->background_color : $crew->background_color_inactive }} !important">
            @slot('title')
                @include('crews.__.flag')
            @endslot

            @slot('options')
            @include('crews.index.quick-buttons')
            @endslot

            <div class="list-group list-group-flush is-sortable" data-crew="{{ $crew->id }}">
                @foreach($crew->members as $member)
                @include('crews.index.is-sortable-item', ['class' => 'list-group-item list-group-item-action px-2 '])
                @endforeach
            </div>

            @if( $crew->hasIncompleteWorkOrders() )
            <x-slot name="footer">
                <div class="text-center">
                @include('work-orders.__.button-counter-incomplete', [
                    'parameters' => ['crew' => $crew->id],
                    'counter' => $crew->incomplete_work_orders_count
                ])
                </div>
            </x-slot>
            @endif
        </x-card>
    </div>
    @endforeach
</div>
