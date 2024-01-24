<x-card title="Members">
    @if( $crew->hasMembers() )       
    <x-table class="align-middle">
        <x-slot name="thead">
            <tr>
                <th>Name</th>
                <th>Contact</th>
                <th></th>
            </tr>
        </x-slot>

        @foreach($crew->members as $member)
        <tr>
            <td>{{ $member->full_name }}</td>
            <td>
                <x-custom.information-contact-channels :channels="$member->contact_data->filter()" type="tooltip" item-class="badge" />
            </td>
            <td class="text-end">
                <a href="{{ route('members.show', $member) }}" class="btn btn-outline-primary btn-sm">
                    <i class="bi bi-eye-fill"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </x-table>
    @endif
</x-card>
