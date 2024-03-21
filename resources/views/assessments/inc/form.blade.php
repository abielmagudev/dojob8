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

<x-form-field-horizontal for="scheduledDateInput" label="Schedule">
    <input type="date" id="scheduledDateInput" class="form-control {{ bsInputInvalid( $errors->has('scheduled_date') ) }}" name="scheduled_date" value="{{ old('scheduled_date', $assessment->scheduled_date_input) }}" required>
    <x-form-feedback error="scheduled_date" />
</x-form-field-horizontal>

<x-form-field-horizontal for="contractorSelect" label="Contractor" label-class="form-label-optional">
    <select id="contractorSelect" class="form-select {{ bsInputInvalid( $errors->has('contractor') ) }}" name="contractor" required>
        <option label="* None"></option>
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
