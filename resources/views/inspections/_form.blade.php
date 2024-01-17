@csrf

<x-form-field-horizontal for="scheduledDateInput" label="Schedule">
    <input id="scheduledDateInput" class="form-control {{ bsInputInvalid( $errors->has('scheduled_date') ) }}" type="date" name="scheduled_date" value="{{ old('scheduled_date', $inspection->scheduled_date_input) }}">
    <x-error name="scheduled_date" />
</x-form-field-horizontal>

<x-form-field-horizontal for="inspectorSelect" label="Inspector">
    <select id="inspectorSelect" class="form-select {{ bsInputInvalid( $errors->has('inspector') ) }}" name="inspector" required>
        @foreach($inspectors as $inspector)
        <option value="{{ $inspector->id }}" {{ isSelected($inspector->id == $inspection->inspector_id) }}>{{ $inspector->name }}</option>
        @endforeach
    </select>
    <x-error name="inspector" />
</x-form-field-horizontal>

<x-form-field-horizontal for="observationsTextarea" label="Observations" label-class="form-label-optional {{ bsInputInvalid( $errors->has('observations') ) }}">
    <textarea id="observationsTextarea" class="form-control" name="observations" rows="3">{{ old('observations', $inspection->observations) }}</textarea>
    <x-error name="observations" />
</x-form-field-horizontal>

<x-form-field-horizontal for="crewSelect" label="Crew">
    <div>
        <select id="crewSelect" class="form-select {{ bsInputInvalid( $errors->has('crew') ) }}" name="crew">
            <option disabeld selected label="None"></option>
            @foreach($crews as $crew)          
            <option value="{{ $crew->id }}" {{ isSelected($crew->id == $inspection->crew_id) }}>{{ $crew->name }}</option>
            @endforeach
        </select>
        <x-error name="crew" />
    </div>
</x-form-field-horizontal>

<x-form-field-horizontal for="statusSelect" label="Status">
    <select id="statusSelect" class="form-select {{ bsInputInvalid( $errors->has('status') ) }}" name="status" required>
        @if( $inspection->id && $inspection->isPendingStatus() )
        <option value="pending" selected>Pending</option>
        @endif

        @foreach($all_status_form as $status)
        <option value="{{ $status }}" {{ isSelected( ($status === $inspection->status) ) }}>{{ ucfirst($status) }}</option>
        @endforeach
    </select>
    <x-error name="status" important>If there is missing schedule, crew information... it will automatically be <b>pending status</b>.</x-error>
</x-form-field-horizontal>
