<x-form-field-horizontal for="contractorSelect" label="Contractor">

    @if( $assessment->id && $assessment->hasContractor() )
    <div class="form-control">{{ $assessment->contractor->name }}</div>
    <input type="hidden" name="contractor" value="{{ $assessment->contractor_id }}">

    @else
    <select id="contractorSelect" class="form-select {{ bsInputInvalid( $errors->has('contractor') ) }}" name="contractor">
        <option selected label="None *"></option>

        @foreach($contractors as $contractor)
        <option value="{{ $contractor->id }}" {{ isSelected($contractor->id == $work_order->contractor_id) }}>{{ $contractor->name }} ({{ $contractor->alias }})</option>
        @endforeach
    </select>
    @endif

    <x-form-feedback error="contractor"></x-error>
</x-form-field-horizontal>
