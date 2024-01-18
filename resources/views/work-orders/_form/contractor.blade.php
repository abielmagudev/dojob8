<x-form-field-horizontal for="contractorSelect" label="Contractor">
    <select id="contractorSelect" class="form-select" name="contractor">
        <option selected label="None"></option>

        @foreach($contractors as $contractor)
        <option value="{{ $contractor->id }}" {{ isSelected($contractor->id == $work_order->contractor_id) }}>{{ $contractor->name }} ({{ $contractor->alias }})</option>
        @endforeach
    </select>

    <x-error name="contractor"></x-error>
</x-form-field-horizontal>
