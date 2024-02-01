@includeWhen($crew->hasIncompleteWorkOrders(), 'work-orders.__.button-counter-incomplete', [
    'parameters' => ['crew' => $crew->id],
    'counter' => $crew->incomplete_work_orders_count
])

<x-tooltip title="Add more crew members">
    <x-modal-trigger 
        modal-id="addCrewMembersModal" 
        class="btn btn-outline-success btn-sm"
        data-crew="{{ 
            json_encode([
                'id' => $crew->id, 
                'name' => $crew->name, 
            ])
        }}" 
    >
        <i class="bi bi-person-plus-fill"></i>
    </x-modal-trigger>
</x-tooltip>

<a href="{{ route('crews.show', $crew) }}" class="btn btn-outline-primary btn-sm">
    <i class="bi bi-eye-fill"></i>
</a>
