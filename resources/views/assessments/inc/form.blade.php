<x-form-field-horizontal label="Client">
    <p>
        <b class="d-block">{{ $client->full_name }}</b>
        <small>
            {{ $client->address_simple }}
            <br>
            {{ $client->contact_channels }}
        </small>
    </p>
    <input type="hidden" name="client" value="{{ $client->id }}">
    <x-form-feedback error="client" />
</x-form-field-horizontal>

<x-form-field-horizontal for="typeSelect" label="Type">
    <select id="typeSelect" name="type" class="form-select" required>
        <option value="0" {{ isSelected( old('type', $assessment->is_walk_thru) == 0 ) }}>Regular</option>
        <option value="1" {{ isSelected( old('type', $assessment->is_walk_thru) == 1 ) }}>Walk Thru</option>
    </select>
    <x-form-feedback error="type" />
</x-form-field-horizontal>

<x-form-field-horizontal for="scheduledDateInput" label="Schedule" label-class="{{ !$assessment->hasScheduledDate() ? 'form-label-pending' : '' }}">
    <input type="date" id="scheduledDateInput" class="form-control {{ bsInputInvalid( $errors->has('scheduled_date') ) }}" name="scheduled_date" value="{{ old('scheduled_date', $assessment->scheduled_date_input) }}">
    <x-form-feedback error="scheduled_date" />
</x-form-field-horizontal>

<x-form-field-horizontal for="crewSelect" label="Crew" label-class="{{ !$assessment->hasCrew() ? 'form-label-pending' : '' }}">
    <select id="crewSelect" class="form-select {{ bsInputInvalid( $errors->has('crew') ) }}" name="crew">
        <option label="Pending *"></option>
        @foreach($crews as $crew)
        <option value="{{ $crew->id }}" {{ isSelected( $crew->id == old('crew', $assessment->crew_id) ) }}>{{ $crew->name }}</option>
        @endforeach
    </select>
    <x-form-feedback error="crew" />

    @if( $assessment->id )
    <div class="form-check mt-1">
        <input class="form-check-input" type="checkbox" name="reassign_crew_members" value="1" id="reassignCrewMemberCheckbox">
        <label class="form-check-label" for="reassignCrewMemberCheckbox">Reassign crew members of the selected crew</label>
    </div>
    @endif
</x-form-field-horizontal>

<x-form-field-horizontal for="contractorSelect" label="Contractor" label-class="form-label-optional">
    <select id="contractorSelect" class="form-select {{ bsInputInvalid( $errors->has('contractor') ) }}" name="contractor">
        <option selected></option>
        @foreach($contractors as $contractor)
        <option value="{{ $contractor->id }}" {{ isSelected( $contractor->id == old('contractor', $assessment->contractor_id) ) }}>{{ $contractor->name }} ({{ $contractor->alias }})</option>
        @endforeach
    </select>
    <x-form-feedback error="contractor" />
</x-form-field-horizontal>

<x-form-field-horizontal for="notesTextarea" label="Notes" label-class="form-label-optional">
    <textarea name="notes" id="notesTextarea" class="form-control {{ bsInputInvalid( $errors->has('notes') ) }}">{{ old('notes', $assessment->notes) }}</textarea>
    <x-form-feedback error="notes" />
</x-form-field-horizontal>
