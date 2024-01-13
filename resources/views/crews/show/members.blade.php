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
                @foreach($member->contact_data->filter() as $key => $value)
                <?php $prefix = $key <> 'email' ? 'tel' : 'mailto' ?>
                <a href="{{ $prefix }}:{{ $value }}" class="mx-1">{{ $value }}</a>
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
