@if( $member->isCrewMember() )
    <x-card title="Crews">

        @if( $member->hasCrews() ) 
        <x-table class="align-middle">
            @slot('thead')
            <tr>
                <th>Name</th>
                <th>Members</th>
                <th></th>
            </tr>
            @endslot

            @foreach($member->crews as $crew)
            <tr>
                <td>{{ $crew->name }}</td>
                <td>
                    @foreach($crew->members->except($member->id) as $member_crew)            
                    <span class="badge border">
                        <a href="{{ route('members.show', $member_crew) }}" class="text-decoration-none">{{ $member_crew->full_name }}</a>
                    </span>
                    @endforeach
                </td>
                <td class="text-end">
                    <a href="{{ route('crews.show', $crew) }}" class="btn btn-outline-primary">
                        <i class="bi bi-eye-fill"></i>
                    </a>
                </td>
            </tr>
            @endforeach
        </x-table>
        @endif
    </x-card>

@else
<br>
<p class="text-center text-secondary text-uppercase ">- Cannot be in crews -</p>

@endif
