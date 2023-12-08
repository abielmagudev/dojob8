@if( $member->canBeInCrews() )
    <x-card 
        :title="$member->hasCrew() ? $member->crew->name : 'Crew'" 
        :subtitle="$member->hasCrew() ? 'Crew' : 'None'"
    >
    @if( $member->hasCrew() && $member->crew->hasMembers() )

        <?php $crew_members = $member->crew->members->filter(function ($crew_member) use ($member) {
            return $crew_member->id <> $member->id;
        }) ?>

        @if( $crew_members->count() )   
        <x-table class="align-middle">
            
            <x-slot name="thead">
                <tr>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Mobile</th>
                    <th>Email</th>
                </tr>
            </x-slot>

            @foreach($crew_members as $crew_member)
            <tr>
                <td>{{ $crew_member->full_name }}</td>
                <td>{{ $crew_member->phone_number }}</td>
                <td>{{ $crew_member->mobile_number }}</td>
                <td>{{ $crew_member->email }}</td>
            </tr>
            @endforeach
        </x-table>
        @endif
    @endif
    </x-card>

@else
<p class="text-center text-secondary">Cannot be in crews</p>

@endif
