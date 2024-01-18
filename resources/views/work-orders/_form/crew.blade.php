<x-form-field-horizontal for="crewSelect" label="Crew">
    <select id="crewSelect" class="form-select" name="crew" required>
        <option disabled selected label="Choose..."></option>
        @foreach($crews as $crew)          

        @if( $crew->id == $work_order->crew_id || $crew->hasTask('work orders') )
        <option value="{{ $crew->id }}" {{ isSelected($crew->id == old('crew', $work_order->crew_id)) }}>{{ $crew->name }}</option>
        @endif

        @endforeach
    </select>
    <x-error name="crew" />
</x-form-field-horizontal>
