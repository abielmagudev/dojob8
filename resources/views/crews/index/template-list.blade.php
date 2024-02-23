<x-card>
    <x-table>
        <x-slot name="thead">
            <tr>
                <th>Name</th>
                <th colspan="2">Members</th>
                <th></th>
            </tr>
        </x-slot>
        
        @foreach($active_crews as $crew)
        <tr>
            <td class="text-nowrap pe-3" style="width:1%">
                @include('crews.__.flag', [
                    'class' => 'w-100',
                ])    
            </td>

            <td style="width:1%">
                <?php $data_crew_json = json_encode([
                    'id' => $crew->id, 
                    'name' => $crew->name, 
                ]) ?>
                <x-tooltip title="Add crew members">
                    <x-modal-trigger data-crew="{{ $data_crew_json }}" modal-id="addCrewMembersModal" class="btn btn-outline-success btn-sm text-nowrap ">
                        <i class="bi bi-person-plus-fill"></i>
                    </x-modal-trigger>
                </x-tooltip>
            </td>

            <td class="text-nowrap" style="max-width:800px">
                <div class="is-sortable d-flex flex-column flex-md-row flex-wrap" data-crew="{{ $crew->id }}">
                @if( $crew->members->count() )
                    @foreach($crew->members as $member)
                    @include('crews.index.is-sortable-item', ['class' => 'small border rounded py-1 px-2 mb-1 mb-md-0 me-md-2'])
                    @endforeach
                @endif
                </div>
            </td>

            <td class="text-nowrap text-end" style="width:1%">
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
            </td>
        </tr>        
        @endforeach
    
    </x-table>
</x-card>
