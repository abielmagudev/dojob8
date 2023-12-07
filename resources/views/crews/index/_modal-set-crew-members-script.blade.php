<x-modal id="modalSetCrewMembers" subtitle="Crew" dialog-class="modal-dialog-scrollable" header-close>

    @slot('title')
    <span id="crewNameTitle"></span>
    @endslot

    <form action="{{ route('crews.members.update', '?') }}" method="post" autocomplete="off" id="formCrewMembersUpdate">
        @csrf
        @method('put')
        <input type="hidden" name="show" value="{{ $show }}">

        <ul class="list-group list-group-flush">        
            @foreach($members as $member) 
            <li class="list-group-item list-group-item-action">
                <div class="form-check d-flex justify-content-between p-0">

                    <?php $checkbox_id = "checkboxMember{$member->id}" ?>

                    <label for="{{ $checkbox_id }}" class="form-check-label w-100">
                        <span class="text-secondary me-2 d-none">
                            <i class="bi bi-person-circle"></i>
                        </span>
                        <span>{{ $member->full_name }}</span>
                    </label>

                    <input id="{{ $checkbox_id }}" type="checkbox" class="form-check-input" name="members[]" value="{{ $member->id }}" >                
                </div>
            </li>
            @endforeach
        </ul>
    </form>
    
    <x-slot name="footer">
        <button class="btn btn-success" type="submit" form="formCrewMembersUpdate">Set members in <span id="crewNameButton"></span></button>
        <x-modal-button-close>Cancel</x-modal-button-close>
    </x-slot>

</x-modal>

@push('scripts')
<script>
    const modalSetCrewMembersTriggers = {
        triggers: 'a[data-crew]',
        listen: function () {
            document.querySelectorAll(this.triggers).forEach(function (item) {
                item.addEventListener('click', function (evt) {
                    let clicked = evt.target.closest('a');

                    modalSetCrewMembers.update( 
                        clicked.dataset.crew
                    )
                })
            })
        }
    }
    
    const modalSetCrewMembers = {
        element: document.getElementById('modalSetCrewMembers'),
        route: "<?= route('crews.members.update', '?') ?>",
        update: function ($data) {
            this.crew = JSON.parse($data)
            this.setFormAction(this.crew.id)
            this.setNames(this.crew.name)
            this.setMembers(this.crew.members)
        },
        setFormAction: function (crew_id) {
            let route = this.route.replace('?', crew_id)
            this.element.querySelector('form').action = route
        },
        setNames: function (name) {
            this.element.querySelector('#crewNameTitle').textContent = name
            this.element.querySelector('#crewNameButton').textContent = name
        },
        setMembers: function (members) {
            let modal = this.element;
    
            members.forEach(function (member) {
                let checkbox = modal.querySelector(`input[type='checkbox'][value='${member.id}']`)
    
                if( checkbox !== null ) {
                    checkbox.checked = true
                }
            })
        },
        clear: function () {
            this.setFormAction('')
            this.setNames('')
            this.element.querySelectorAll('input[type="checkbox"]').forEach((checkbox) => checkbox.checked = false)
        },
        listen: function () {
            this.element.addEventListener('hidden.bs.modal', function () {
                modalSetCrewMembers.clear()
            })
        }
    }
    
    modalSetCrewMembersTriggers.listen()
    modalSetCrewMembers.listen()
</script>
@endpush
