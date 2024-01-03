@include('crews.index._toolbar')

<div class="row">
@foreach($crews as $crew)
    <div class="col-md col-md-6 col-lg-3 mb-3">
        <x-card title="{{ $crew->name }}" class="h-100" style="border-top:0.8rem solid {{ $crew->background_color }} !important">

            @slot('options')
            @include('crews.index._work-order-button-group')
            <a href="{{ route('crews.show', $crew) }}" class="btn btn-outline-primary btn-sm">
                <i class="bi bi-eye-fill"></i>
            </a>
            @endslot

            <div class="list-group list-group-flush list-sortable" id="crew{{ $crew->id }}">
                @if( $crew->hasMembers() )
                @foreach($crew->members as $member)
                <div class="list-group-item list-group-item-action cursor-move" role="button">
                    <span>{{ $member->full_name }}</span>
                    <input type="hidden" name="members[]" value="{{ $member->id }}">
                </div>
                @endforeach
                @endif
            </div>

            @if( $crew->isActive() )           
            <div class="list-group list-group-flush">
                <div class="list-group-item list-group-item-action text-center">
                    <x-modal-trigger modal-id="modalSetCrewMembers" data-crew="{{ $crew->dataset_json }}" class="d-block" link>
                        <i class="bi bi-arrow-repeat"></i>
                    </x-modal-trigger>
                </div>
            </div>
            @endif
        </x-card>
    </div>
@endforeach


@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.1/Sortable.min.js"></script>

<script>
const setCrewMembersRequest = {
    route: "<?= route('crews.members.update', '?') ?>",
    cache: {},
    send: async function (members_id, crew_id, crew_old) {
        let route = this.route.replace('?', crew_id)

        let response = await fetch(route, {
            method: 'PUT',
            headers: {
                'X-CSRF-TOKEN': "<?= csrf_token() ?>",
                'Content-Type': 'application/json',
                'Accept': 'application/json',
            },
            body: JSON.stringify({
                members: members_id,
                crew_old: this.cache.crew_old,
            }),
        });

        let data = response.json();

        return data;
    }
}

document.querySelectorAll('.list-sortable').forEach(function (listing) {
    new Sortable(listing, {
        group: {
            name: 'shared',
            // pull: 'clone',
        },
        animation: 150,
        onChoose: function (evt) {
            setCrewMembersRequest.cache.crew_old = evt.target.id.replace('crew', '');
	    },
        onAdd: async function (evt) {
            let wrapper = evt.target

            let crew_id = wrapper.id.replace('crew','');

            let members_id = Array.from(
                wrapper.querySelectorAll('input[type="hidden"]')
            ).map((input) => input.value)

            let data = await setCrewMembersRequest.send(members_id, crew_id, this.crew_old);

            wrapper.nextElementSibling.querySelector('a[data-crew]').dataset.crew = data.dataset
        }
    });
}) 
</script>
@endpush
