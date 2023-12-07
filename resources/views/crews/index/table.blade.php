<x-card>

    @include('crews.index._toolbar')

    <x-table class="align-middle">
        <x-slot name="thead">
            <tr>
                <th></th>
                <th>Name</th>
                <th class="text-nowrap">Members</th>
                <th></th>
            </tr>
        </x-slot>

        @foreach($crews as $crew)
        <tr>
            <td class="text-center" style="width:1%; font-size:1.2rem">
                @if(! $crew->isActive() )
                <x-tooltip title="Inactive">
                    <i class="bi bi-dash-circle"></i>
                </x-tooltip>
                    
                @else
                <x-tooltip title="Active">
                    <i class="bi bi-circle-fill" style="color:{{ $crew->background_color }}"></i>
                </x-tooltip>

                @endif
            </td>
            <td>{{ $crew->name }}</td>
            <td>
                @if( $crew->members->count() )
                @foreach($crew->members as $member)
                <span class="badge text-bg-light">{{ $member->full_name }}</span>
                @endforeach
                @endif
            </td>
            <td class="text-nowrap text-end">

                @include('crews.index._work-order-button-group')

                <?php $modal_data = [
                    'id' => $crew->id,
                    'name' => $crew->name,
                    'members' => $crew->members->map(function ($member) {
                        return [
                            'id' => $member->id,
                            'full_name' => $member->full_name,
                        ];
                    })
                ] ?>

                @if( $crew->isActive() )   
                <x-modal-trigger modal-id="modalSetCrewMembers" class="btn btn-outline-primary" data-crew="{{ json_encode($modal_data) }}" link>
                    <i class="bi bi-plus-circle-dotted"></i>
                </x-modal-trigger>
                @endif

                <a href="{{ route('crews.show', $crew) }}" class="btn btn-outline-primary">
                    <i class="bi bi-eye-fill"></i>
                </a>
            </td>
        </tr>        
        @endforeach

    </x-table>
</x-card>
