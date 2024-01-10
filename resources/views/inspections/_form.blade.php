@csrf
<x-form-field-horizontal for="scheduledDateInput" label="Schedule">
    <input id="scheduledDateInput" class="form-control {{ bsInputInvalid( $errors->has('scheduled_date') ) }}" type="date" name="scheduled_date" value="{{ old('scheduled_date', $inspection->scheduled_date_input) }}">
    <x-error name="scheduled_date" />
</x-form-field-horizontal>

<x-form-field-horizontal for="inspectorSelect" label="Inspector">
    <select id="inspectorSelect" class="form-select" name="inspector" required>
        @foreach($inspectors as $inspector)
        <option value="{{ $inspector->id }}" {{ isSelected($inspector->id == $inspection->inspector_id) }}>{{ $inspector->name }}</option>
        @endforeach
    </select>
    <x-error name="inspector" />
</x-form-field-horizontal>

<x-form-field-horizontal for="crewSelect" label="Crew">
    <div>
        <select id="crewSelect" class="form-select" name="crew">
            <option disabeld selected label="- Pending crew -"></option>
            @foreach($crews as $crew)          
            <option value="{{ $crew->id }}" {{ isSelected($crew->id == $inspection->crew_id) }}>{{ $crew->name }}</option>
            @endforeach
        </select>
        <x-error name="crew" />
    </div>
</x-form-field-horizontal>

@if( $inspection->id )
<x-form-field-horizontal for="observationsTextarea" label="Observations" label-class="form-label-optional {{ bsInputInvalid( $errors->has('observations') ) }}">
    <textarea id="observationsTextarea" class="form-control" name="observations" rows="3">{{ old('observations', $inspection->observations) }}</textarea>
    <x-error name="observations" />
</x-form-field-horizontal>

<x-form-field-horizontal for="statusSelect" label="Status">
    <select id="statusSelect" class="form-select" name="status">
        @if( $inspection->isPendingStatus() )
        <option value="pending">Pending</option>

        @else
        @foreach($form_statuses as $status)
        <option value="{{ $status }}" {{ isSelected( ($status === $inspection->status) ) }}>{{ ucfirst($status) }}</option>
        @endforeach

        @endif
    </select>
    <x-error name="status" />
</x-form-field-horizontal>
@endif
