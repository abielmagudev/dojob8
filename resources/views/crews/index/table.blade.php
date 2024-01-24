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
                <x-tooltip title="{{ ucfirst($crew->presence_status) }}">
                    <i class="bi bi-circle-fill" style="color:{{ $crew->isActive() ? $crew->background_color : '#CCCCCC' }}"></i>
                </x-tooltip>
            </td>
            <td>
                @include('crews.__.flag')    
            </td>
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
                <x-modal-trigger modal-id="modalSetCrewMembers" class="btn btn-outline-primary btn-sm" data-crew="{{ json_encode($modal_data) }}" link>
                    <i class="bi bi-arrow-repeat"></i>
                </x-modal-trigger>
                @endif

                <a href="{{ route('crews.show', $crew) }}" class="btn btn-outline-primary btn-sm">
                    <i class="bi bi-eye-fill"></i>
                </a>
            </td>
        </tr>        
        @endforeach

    </x-table>
</x-card>
