@csrf
<x-form-control-horizontal class="align-items-center">
    <x-slot name="label">
        <label for="scheduledDateInput" class="form-label">Schedule</label>
    </x-slot>

    <input id="scheduledDateInput" class="form-control {{ bsInputInvalid( $errors->has('scheduled_date') ) }}" type="date" name="scheduled_date" value="{{ old('scheduled_date', $inspection->scheduled_date_input) }}">
    <x-error name="scheduled_date" />
</x-form-control-horizontal>

<x-form-control-horizontal class="align-items-center">
    <x-slot name="label">
        <label for="inspectorSelect" class="form-label">Inspector</label>
    </x-slot>

    <select id="inspectorSelect" class="form-select" name="inspector" required>
        @foreach($inspectors as $inspector)
        <option value="{{ $inspector->id }}" {{ isSelected($inspector->id == $inspection->inspector_id) }}>{{ $inspector->name }}</option>
        @endforeach
    </select>
    <x-error name="inspector" />
</x-form-control-horizontal>

<x-form-control-horizontal>
    <x-slot name="label">
        <label for="crewSelect" class="form-label">Crew</label>
    </x-slot>

    <div>
        <select id="crewSelect" class="form-select" name="crew">
            <option disabeld selected label="Choose..."></option>
            @foreach($crews as $crew)          

            @if( $crew->hasTypeTask('inspections') || $crew->id == $inspection->crew_id )
            <option value="{{ $crew->id }}" {{ isSelected($crew->id == $inspection->crew_id) }}>{{ $crew->name }}</option>
            @endif

            @endforeach
        </select>
        <x-error name="crew" />
    </div>
</x-form-control-horizontal>

@if( $inspection->id )
<x-form-control-horizontal class="align-items-center">
    <x-slot name="label">
        <label for="observationsTextarea" class="form-label {{ bsInputInvalid( $errors->has('observations') ) }}">Observations</label>
    </x-slot>
    
    <textarea id="observationsTextarea" class="form-control" name="observations" rows="3">{{ old('observations', $inspection->observations) }}</textarea>
    <x-error name="observations" />
</x-form-control-horizontal>

<x-form-control-horizontal class="align-items-center">
    <x-slot name="label">
        <label for="statusSelect" class="form-label">Status</label>
    </x-slot>

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
</x-form-control-horizontal>
@endif
