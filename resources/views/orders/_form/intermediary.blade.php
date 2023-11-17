<div class="row mb-3">
    <div class="col-md">
        <label for="intermediarySelect" class="form-label">Intermediary</label>
    </div>
    <div class="col-md col-md-9 col-lg-10">
        <select id="intermediarySelect" class="form-select" name="intermediary">
            <option disabled selected label="..."></option>
            @foreach($intermediaries as $intermediary)
            <option value="{{ $intermediary->id }}">{{ $intermediary->name }} ({{ $intermediary->alias }})</option>
            @endforeach
        </select>
    </div>
</div>
