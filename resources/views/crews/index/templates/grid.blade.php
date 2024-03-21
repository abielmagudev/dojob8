<div class="row">
    @foreach($active_crews as $crew)
    <div class="col-sm col-sm-6 col-md-4 col-xl-3 mb-4">
        <?php $style = sprintf('border-top:0.5rem solid %s !important', $crew->colors->background ) ?> 
        <x-card class="h-100" :style="$style">
            
            <x-slot name="title">{{ $crew->name }} </x-slot>

            <x-slot name="options">
                @includeWhen($crew->hasIncompleteWorkOrders(), 'work-orders.__.button-counter-incomplete', [
                    'parameters' => ['crew' => $crew->id],
                    'counter' => $crew->incomplete_work_orders_counter
                ])

                @includeWhen($crew->hasAwaitingInspections(), 'inspections.__.button-counter-awaiting', [
                    'parameters' => ['crew' => $crew->id],
                    'counter' => $crew->awaiting_inspections_counter
                ])

                <a href="{{ route('crews.show', $crew) }}" class="btn btn-outline-primary btn-sm">
                    <i class="bi bi-eye-fill"></i>
                </a>
            </x-slot>

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
