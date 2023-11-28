<x-modal id="crewMembersUpdateModal" title="Add or remove members" dialog-class="modal-dialog-scrollable" header-close>

    <form action="{{ route('crews.members.update', $crew) }}" method="post" autocomplete="off" id="formCrewMembersUpdate">
        @csrf
        @method('put')

        <ul class="list-group list-group-flush">
            <li class="list-group-item list-group-item-secondary text-capitalize py-3">Operative</li>
        
            @foreach($members_operative as $member) 
            <?php $checkbox_id = "checkboxMember{$member->id}" ?>      
            <li class="list-group-item list-group-item-action">
                <div class="form-check">
                    <input id="{{ $checkbox_id }}" type="checkbox" class="form-check-input" name="members[]" value="{{ $member->id }}" {{isChecked( $crew->members->contains($member->id) ) }}>
                    <label for="{{ $checkbox_id }}" class="form-check-label">{{ $member->full_name }}</label>
                </div>
            </li>
            @endforeach
        </ul>
    </form>
    
    <x-slot name="footer">
        <button class="btn btn-success" type="submit" form="formCrewMembersUpdate">Update crewers</button>
        <x-modal-button-close>Cancel</x-modal-button-close>
    </x-slot>

</x-modal>
