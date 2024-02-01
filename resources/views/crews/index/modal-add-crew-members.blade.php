<x-modal id="addCrewMembersModal" title="Add more crew members">
    <form action="{{ route('crews.update.members') }}" method="post" autocomplete="off" id="addCrewMembersForm">
        @method('put')
        @csrf

        <div class="mb-3">
            <label for="crewSelect" class="form-label">Crew</label>
            <div class="form-control"></div>
            <input type="hidden" name="crew" required>
            <x-form-feedback error="crew" />
        </div>

        <div class="mb-3">
            <label class="form-label">Members</label>
            <div class="form-control p-0 overflow-y-scroll" style="max-height:50vh">
                <ul class="list-group list-group-flush rounded overflow-hidden">
                    @foreach($members as $member)
                    <?php $checkbox_id = sprintf('member%sCheckbox', $member->id) ?>
                    <li class="list-group-item list-group-item-action">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <i class="bi bi-person-bounding-box"></i>
                                <label for="{{ $checkbox_id }}" class="form-check-label ms-2">{{ $member->full_name }}</label>
                            </div>
                            <div>
                                <input id="{{ $checkbox_id }}" class="form-check-input" type="checkbox" name="members[]" value="{{ $member->id }}">
                            </div>
                        </div>
                    </li>      
                    @endforeach
                </ul>
            </div>
            <x-form-feedback error="members" />
            <x-form-feedback error="members.*" />
            <small class="text-secondary">Scroll up or down</small>
        </div>

        <div class="mb-3 d-none">
            <div class="text-center text-secondary">
                <b>Has all the crew members</b>
            </div>
        </div>
    </form>

    @slot('footer')
    <x-modal-button-close>Cancel</x-modal-button-close>
    <button class="btn btn-success" type="submit" form="addCrewMembersForm">Update crew members</button>
    @endslot
</x-modal>

@push('scripts')
<script>
const addCrewMembersForm = {
    form: function () {
        return document.getElementById('addCrewMembersForm');
    },
    contents: function () {
        return {
            cache: null,
            get: function (index = null) {
                if( this.cache == null ) {
                    this.cache = Array.from(addCrewMembersForm.form().querySelectorAll(':scope > div'));
                }

                return index != null ? this.cache[index] : this.cache;
            }
        }
    },
    checkboxes: function () {
        return this.form().querySelectorAll('input[type="checkbox"][name="members[]"]')
    },
    load: function (crew) {// Usar un conjunto para mejor rendimiento
        this.contents().get(0).querySelector('.form-control').textContent = crew.name; // Crew name
        this.contents().get(0).querySelector('input[name="crew"]').value = crew.id; // Crew id

        this.checkboxes().forEach(checkbox => {
            let validated = crew.id_members.includes( checkbox.value );                
            checkbox.closest('.list-group-item').classList.toggle('d-none', validated)
            checkbox.checked = validated;
        });

        let has_all_crew_members = Array.from(this.checkboxes()).filter(checkbox => checkbox.checked == false).length == 0;
        this.contents().get(1).classList.toggle('d-none', has_all_crew_members) // Checkboxes
        this.contents().get(2).classList.toggle('d-none', !has_all_crew_members) // Message for has_all_crew_members
    }
};
</script>
@endpush
