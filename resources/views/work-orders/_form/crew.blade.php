<x-form-field-horizontal for="crewSelect" label="Crew" label-class="{{ !$work_order->hasCrew() ? 'form-label-pending' : '' }}">
    <select id="crewSelect" class="form-select {{ bsInputInvalid( $errors->has('crew') ) }}" name="crew">
        <option disabled selected></option>

        @foreach($crews as $crew)          
        <option value="{{ $crew->id }}" {{ isSelected($crew->id == old('crew', $work_order->crew_id)) }}>
            {{ $crew->name }}
        </option>
        @endforeach

        @if( $work_order->crew &&! $crews->contains($work_order->crew_id) )
        <option value="{{ $work_order->crew->id }}" selected>
            {{ $work_order->crew->name }} - It is inactive or it is not for work order tasks
        </option>
        @endif
    </select>
    <x-form-feedback error="crew" />
</x-form-field-horizontal>
