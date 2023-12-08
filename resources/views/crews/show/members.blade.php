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
                @foreach($member->contact_data_collection->filter() as $key => $value)
                @if( $key <> 'email' )
                    <span class="badge text-bg-light">
                        <x-link-phone href="{{ $value }}">{{ $value }}</x-link-phone>
                    </span>
                
                @else
                    <span class="badge text-bg-light">
                        <x-link-email href="{{ $value }}">{{ $value }}</x-link-email>
                    </span>

                @endif
                @endforeach
            </td>
            <td class="text-end">
                <a href="{{ route('members.show', $member) }}" class="btn btn-outline-primary">
                    <i class="bi bi-eye-fill"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </x-table>
    @endif
</x-card>
