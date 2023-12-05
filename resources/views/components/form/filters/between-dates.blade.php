<div class="mb-3">
    <div class="row g-3">
        <div class="col-sm">
            <label for="filterBetweenFromDateInput" class="form-label">From</label>
            <input id="filterBetweenFromDateInput" class="form-control" type="date" name="between_dates[]" value="{{ $request->input('between_dates.0') }}">
        </div>
        <div class="col-sm">
            <label for="filterBetweenToDateInput" class="form-label">To</label>
            <input id="filterBetweenToDateInput" class="form-control" type="date" name="between_dates[]" value="{{ $request->input('between_dates.1') }}">
        </div>
    </div>
</div>
