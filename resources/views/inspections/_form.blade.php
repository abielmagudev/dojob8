@csrf
<x-custom.form-control-horizontal class="align-items-center">
    <x-slot name="label">
        <label for="scheduleInput" class="form-label">Schedule</label>
    </x-slot>

    <input id="scheduleInput" class="form-control {{ bsInputInvalid( $errors->has('schedule') ) }}" type="date" name="schedule" value="{{ old('schedule', ($inspection->scheduled_date ? $inspection->scheduled_date->format('Y-m-d') : null)) }}" required>
    <x-error name="schedule" />
</x-custom.form-control-horizontal>

<x-custom.form-control-horizontal class="align-items-center">
    <x-slot name="label">
        <label for="inspectorSelect" class="form-label">Inspector</label>
    </x-slot>

    <select id="inspectorSelect" class="form-select" name="inspector">
        @foreach($inspectors as $inspector)
        <option value="{{ $inspector->id }}">{{ $inspector->name }}</option>
        @endforeach
    </select>
    <x-error name="inspector" />
</x-custom.form-control-horizontal>

<x-custom.form-control-horizontal class="align-items-center">
    <x-slot name="label">
        <label for="observationsTextarea" class="form-label {{ bsInputInvalid( $errors->has('observations') ) }}">Observations</label>
    </x-slot>
    
    <textarea id="observationsTextarea" class="form-control" name="observations" rows="3">{{ old('observations', $inspection->observations) }}</textarea>
    <x-error name="observations" />
</x-custom.form-control-horizontal>

<x-custom.form-control-horizontal class="align-items-center">
    <x-slot name="label">
        <label for="notesTextarea" class="form-label {{ bsInputInvalid( $errors->has('notes') ) }}">Notes</label>
    </x-slot>
    
    <textarea id="notesTextarea" class="form-control" name="notes" rows="3">{{ old('notes', $inspection->notes) }}</textarea>
    <x-error name="notes" />
</x-custom.form-control-horizontal>

@if( $inspection->id )
<x-custom.form-control-horizontal class="align-items-center">
    <x-slot name="label">
        <label for="statusSelect" class="form-label">Status</label>
    </x-slot>

    <select id="statusSelect" class="form-select" name="status">
        @foreach($inspection::getAllStatus() as $key => $label)
        <option value="{{ $key }}" {{ isSelected( ($key === $inspection->status) ) }}>{{ ucfirst($label) }}</option>
        @endforeach
    </select>
</x-custom.form-control-horizontal>
@endif