<x-form-field-horizontal for="scheduledDateInput" label="Schedule" label-class="{{ $inspection->hasPendingAttributes() ? 'form-label-pending' : '' }}">
    <input id="scheduledDateInput" class="form-control {{ bsInputInvalid( $errors->has('scheduled_date') ) }}" type="date" name="scheduled_date" value="{{ old('scheduled_date', $inspection->scheduled_date_input) }}" autofocus>
    <x-form-feedback error="scheduled_date" />
</x-form-field-horizontal>

<x-form-field-horizontal for="agencySelect" label="Agency">
    <select id="agencySelect" class="form-select {{ bsInputInvalid( $errors->has('agency') ) }}" name="agency" required>
        @foreach($agencies as $agency)
        <option value="{{ $agency->id }}" {{ isSelected($agency->id == $inspection->agency_id) }}>{{ $agency->name }}</option>
        @endforeach
    </select>
    <x-form-feedback error="agency" />
</x-form-field-horizontal>

<x-form-field-horizontal for="inspectorNameInput" label="Inspector" label-class="form-label-optional">
    <input id="inspectorNameInput" class="form-control" type="text" list="inspectorNamesDatalist" name="inspector_name" value="{{ old('inspector_name', $inspection->inspector_name) }}">
    <datalist id="inspectorNamesDatalist">
        @foreach($inspector_names as $inspector_name)
        <option value="{{ $inspector_name }}">
        @endforeach
    </datalist>
    <x-form-feedback error="inspector_name" />
</x-form-field-horizontal>

<x-form-field-horizontal for="observationsTextarea" label="Observations" label-class="form-label-optional {{ bsInputInvalid( $errors->has('observations') ) }}">
    <textarea id="observationsTextarea" class="form-control" name="observations" rows="3">{{ old('observations', $inspection->observations) }}</textarea>
    <x-form-feedback error="observations" />
</x-form-field-horizontal>

<x-form-field-horizontal for="crewSelect" label="Crew">
    <select id="crewSelect" class="form-select {{ bsInputInvalid( $errors->has('crew') ) }}" name="crew">
        <option disabeld selected label="* NO CREW"></option>
        @foreach($crews as $crew)          
        <option value="{{ $crew->id }}" {{ isSelected($crew->id == $inspection->crew_id) }}>{{ $crew->name }}</option>
        @endforeach
    </select>

    @if( $inspection->id )     
    <div class="mt-1">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="replace_crew_members" value="1" id="checkboxReplaceCrewMembers">
            <label class="form-check-label small" for="checkboxReplaceCrewMembers"><b class="text-danger">WARNING!</b> Remove crew members and add new ones from the selected crew.</label>
        </div>
    </div>
    @endif

    <x-form-feedback error="crew" />
</x-form-field-horizontal>

<x-form-field-horizontal for="statusSelect" label="Status">
    <select id="statusSelect" class="form-select {{ bsInputInvalid( $errors->has('status') ) }}" name="status" required>
        @foreach($all_statuses as $status)
        <option value="{{ $status }}" {{ isSelected( ($status === $inspection->status) ) }}>{{ ucfirst($status) }}</option>
        @endforeach

    </select>
    <x-form-feedback error="status" />

    @if( $inspection->hasPendingAttributes() )
    <div class="alert alert-warning mt-3">If there is any missing information, such as the schedule, it will appear as a <b>pending status</b>.</div>
    @endif
</x-form-field-horizontal>
