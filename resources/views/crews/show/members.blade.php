<x-card title="Members">
    <x-slot name="options">
        <x-tooltip title="Add or remove">
            <x-modal-trigger modal-id="crewMembersUpdateModal">
                <i class="bi bi-people-fill"></i>
            </x-modal-trigger>
        </x-tooltip>
    </x-slot>

    @if( $crew->members->count() )       
    <x-table>
        <x-slot name="thead">
            <tr>
                <th>Name</th>
                <th>Phone</th>
                <th>Mobile</th>
                <th>Email</th>
            </tr>
        </x-slot>

        @foreach($crew->members as $member)
        <tr>
            <td>{{ $member->full_name }}</td>
            <td>{{ $member->phone_number }}</td>
            <td>{{ $member->mobile_number }}</td>
            <td>{{ $member->email }}</td>
        </tr>
        @endforeach
    </x-table>
    @endif
</x-card>
