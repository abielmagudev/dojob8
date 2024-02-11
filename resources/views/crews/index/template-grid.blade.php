<div class="row">
    @foreach($active_crews as $crew)
    <div class="col-md col-md-6 col-lg-3 mb-4">

        <x-card class="h-100" style="border-top:0.5rem solid {{ $crew->isActive() ? $crew->background_color : $crew->background_color_inactive }} !important">
            @slot('title')
                @include('crews.__.flag')
            @endslot

            @slot('options')
                @includeWhen($crew->hasIncompleteWorkOrders(), 'work-orders.__.button-counter-incomplete', [
                    'parameters' => ['crew' => $crew->id],
                    'counter' => $crew->incomplete_work_orders_counter
                ])
                
                @includeWhen($crew->hasPendingInspections(), 'inspections.__.button-counter-pending', [
                    'parameters' => ['crew' => $crew->id],
                    'counter' => $crew->pending_inspections_counter
                ])

                <a href="{{ route('crews.show', $crew) }}" class="btn btn-outline-primary btn-sm">
                    <i class="bi bi-eye-fill"></i>
                </a>
            @endslot

            <div class="list-group list-group-flush is-sortable" data-crew="{{ $crew->id }}">
            @foreach($crew->members as $member)
                @include('crews.index.is-sortable-item', ['class' => 'list-group-item list-group-item-action px-2'])
            @endforeach
            </div>

            <x-slot name="footer">
                <div class="text-center">
                    <?php $data_crew_json = json_encode([
                        'id' => $crew->id, 
                        'name' => $crew->name, 
                    ]) ?>
                    <x-modal-trigger data-crew="{{ $data_crew_json }}" modal-id="addCrewMembersModal" class="btn btn-outline-success btn-sm">
                        <i class="bi bi-person-plus-fill"></i>
                        <span>Add crew members</span>
                    </x-modal-trigger>
                </div>
            </x-slot>
        </x-card>
    </div>
    @endforeach
</div>
