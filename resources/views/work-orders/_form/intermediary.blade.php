<x-form-control-horizontal class="align-items-center">
    <x-slot name="label">
        <label for="intermediarySelect" class="form-label">Intermediary</label>
    </x-slot>

    <select id="intermediarySelect" class="form-select" name="intermediary">
        <option disabled selected label="..."></option>
        @foreach($intermediaries as $intermediary)
        <option value="{{ $intermediary->id }}">{{ $intermediary->name }} ({{ $intermediary->alias }})</option>
        @endforeach
    </select>
</x-form-control-horizontal>
