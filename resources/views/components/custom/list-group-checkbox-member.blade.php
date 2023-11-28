<?php $members_checked = $attributes->get('members-checked', collect([])) ?>

<ul class="list-group list-group-flush">
    <li class="list-group-item list-group-item-secondary text-capitalize py-3 d-none">Operative</li>

    @foreach($members as $member) 
    <?php $checkbox_id = "checkboxMember{$member->id}" ?>      
    <li class="list-group-item list-group-item-action">
        <div class="form-check">
            <input id="{{ $checkbox_id }}" type="checkbox" class="form-check-input" name="members[]" value="{{ $member->id }}" {{isChecked( $members_checked->contains($member->id) ) }}>
            <label for="{{ $checkbox_id }}" class="form-check-label">{{ $member->full_name }}</label>
        </div>
    </li>
    @endforeach
</ul>
