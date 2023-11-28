<x-form-control-horizontal>
    <x-slot name="label">
        <label for="crewSelect" class="form-label">Crew</label>
    </x-slot>

    <div class="mb-3">
        <select id="crewSelect" class="form-select" name="status">
            <option disabled selected label="Without crew..."></option>
            @foreach($crews as $crew)
            <option value="{{ $crew->id }}" {{ isSelected($crew->id == $work_order->crew_id) }}>{{ $crew->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="border rounded" style="height:160px; overflow-y:scroll">
        <x-custom.list-group-checkbox-member :members="$operators" :members-checked="$work_order->crew->members" />
    </div>
</x-form-control-horizontal>
