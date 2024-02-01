@extends('application')
@section('header')
<x-page-title>Crews</x-page-title>
@endsection

@section('after-header')
@include('crews.index.toolbar')
<hr class="mt-3 mb-4">
@endsection

@section('content')
@include("crews.index.template-{$template}")
@include('crews.index.modal-add-crew-members')
@include('crews.index.modal-change-status-crews')
@include('crews.index.modal-set-work-order-workers')

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.1/Sortable.min.js"></script>
<script>
document.querySelectorAll('.is-sortable').forEach(function (listing) {
    new Sortable(listing, {
        group: {
            name: 'shared',
            pull: 'clone',
        },
        animation: 150,
        draggable: '.is-sortable-item',
        onAdd: async function (evt) {
            let crew_id = parseInt(evt.to.dataset.crew);
            let response = await updateCrewMembers.send(crew_id);
            // console.log(response)
        },
        onClone: function (evt) {
            removeCrewMemberButton.add(evt.clone)
            // console.log(evt.clone)
        }
    });
}) 

const crewMemberInputs = {
    get: function (crew_id) {
        return document.body.querySelector(`.is-sortable[data-crew="${crew_id}"]`).querySelectorAll('input[name="members[]"]');
    }
}

const updateCrewMembers = {
    url: "<?= route('crews.update.members') ?>",
    send: async function (crew_id) {
        let result = await fetch(this.url, {
            method: 'PUT',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': "<?= csrf_token() ?>",
                'X-Requested-With': 'XMLHttpRequest',
            },
            body: JSON.stringify({
                crew: crew_id,
                members: Array.from( crewMemberInputs.get(crew_id) ).map(input => input.value),
            }),
        });

        let response = await result.json();

        return response;
    }
}

const removeCrewMemberButton = {
    elements: document.body.querySelectorAll('.remove-member-button'),
    add: function (element) {
        element.addEventListener('click', async function () {
            let crew_id = parseInt(this.closest('.is-sortable-item').parentNode.dataset.crew);

            if( Number.isInteger(crew_id) )
            {
                this.closest('.is-sortable-item').remove()
                let response = await updateCrewMembers.send(crew_id);
            }
        })
    },
    listen: function () {
        this.elements.forEach(function(element) {
            removeCrewMemberButton.add(element)
        })
    }
}
removeCrewMemberButton.listen()

const addCrewMembersModalButton = {
    triggers: function () {
        return document.body.querySelectorAll(`button[data-bs-target="#addCrewMembersModal"]`)
    },
    data: function (trigger) {
        let data = JSON.parse(trigger.dataset.crew);
        data.id_members = Array.from(crewMemberInputs.get(data.id)).map(i => i.value) // new Set(JSON.parse(data.id_members))
        return data;
    },
    listen: function () {
        this.triggers().forEach(function (trigger) {
            trigger.addEventListener('click', function (evt) {
                let data = addCrewMembersModalButton.data(this)
                addCrewMembersForm.load(data)
            })
        })
    }
}
addCrewMembersModalButton.listen()
</script>
@endpush
@endsection
