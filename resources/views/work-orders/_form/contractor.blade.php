<x-form-control-horizontal class="align-items-center">
    <x-slot name="label">
        <label for="contractorSelect" class="form-label">Contractor</label>
    </x-slot>

    <select id="contractorSelect" class="form-select" name="contractor">
        <option disabled selected label="..."></option>
        @foreach($contractors as $contractor)
        <option value="{{ $contractor->id }}" {{ isSelected($contractor->id == $work_order->contractor_id) }}>{{ $contractor->name }} ({{ $contractor->alias }})</option>
        @endforeach
    </select>

    <x-error name="contractor"></x-error>
</x-form-control-horizontal>
