<x-form-control-horizontal>
    <x-slot name="label">
        <label for="crewSelect" class="form-label">Crew</label>
    </x-slot>

    <div class="mb-3">
        <select id="crewSelect" class="form-select" name="crew">
            <option disabled selected label="Without crew..."></option>
            @foreach($crews as $crew)
            <option value="{{ $crew->id }}" {{ isSelected($crew->id == $work_order->crew_id) }}>{{ $crew->name }}</option>
            @endforeach
        </select>
        <x-error name="crew" />
    </div>
</x-form-control-horizontal>
