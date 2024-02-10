<x-card>
    <x-table class="align-middle">
        <x-slot name="thead">
            <tr>
                <th>Name</th>
                <th class="text-nowrap ps-5">Members</th>
                <th></th>
                <th></th>
            </tr>
        </x-slot>
        
        @foreach($active_crews as $crew)
        <tr>
            <td class="text-nowrap" style="width:1%">
                @include('crews.__.flag')    
            </td>
            <td class="ps-5" style="min-width:320px;max-width:600px">
                <div class="is-sortable" data-crew="{{ $crew->id }}">
                @if( $crew->members->count() )
                    @foreach($crew->members as $member)
                    @include('crews.index.is-sortable-item',['class' => 'd-inline-block border rounded py-1 px-2 mx-1 small'])
                    @endforeach
                @endif
                </div>
            </td>
            <td class="text-nowrap" style="width:1%">
                @if( $crew->hasIncompleteWorkOrders() )
                @include('work-orders.__.button-counter-incomplete', [
                    'parameters' => ['crew' => $crew->id],
                    'counter' => $crew->incomplete_work_orders_count
                ])
                @endif
            </td>
            <td class="text-nowrap text-end" style="width:1%">
                @include('crews.index.quick-buttons')
            </td>
        </tr>        
        @endforeach
    
    </x-table>
</x-card>
