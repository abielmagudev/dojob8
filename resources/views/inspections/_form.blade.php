@csrf
<x-form-control-horizontal class="align-items-center">
    <x-slot name="label">
        <label for="scheduledDateInput" class="form-label">Schedule</label>
    </x-slot>

    <input id="scheduledDateInput" class="form-control {{ bsInputInvalid( $errors->has('scheduled_date') ) }}" type="date" name="scheduled_date" value="{{ old('scheduled_date', $inspection->scheduled_date_input) }}" required>
    <x-error name="scheduled_date" />
</x-form-control-horizontal>

<x-form-control-horizontal class="align-items-center">
    <x-slot name="label">
        <label for="inspectorSelect" class="form-label">Inspector</label>
    </x-slot>

    <select id="inspectorSelect" class="form-select" name="inspector">
        @foreach($inspectors as $inspector)
        <option value="{{ $inspector->id }}" {{ isSelected($inspector->id == $inspection->inspector_id) }}>{{ $inspector->name }}</option>
        @endforeach
    </select>
    <x-error name="inspector" />
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
        <label for="notesTextarea" class="form-label {{ bsInputInvalid( $errors->has('notes') ) }}">Notes</label>
    </x-slot>
    
    <textarea id="notesTextarea" class="form-control" name="notes" rows="3">{{ old('notes', $inspection->notes) }}</textarea>
    <x-error name="notes" />
</x-form-control-horizontal>

<x-form-control-horizontal class="align-items-center">
    <x-slot name="label">
        <label for="statusSelect" class="form-label">Status</label>
    </x-slot>

    <select id="statusSelect" class="form-select" name="status">
        @foreach($statuses_values as $status => $value)
        <option value="{{ $value }}" {{ isSelected( ($value === $inspection->is_approved) ) }}>{{ ucfirst($status) }}</option>
        @endforeach
    </select>
    <x-error name="status" />
</x-form-control-horizontal>
@endif
