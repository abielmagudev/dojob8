<div class="mb-3">
    <div class="row g-3">
        <div class="col-sm">
            <label for="filterFromDateFromInput" class="form-label">From</label>
            <input id="filterFromDateFromInput" class="form-control" type="date" name="from_date" value="{{ $request->get('from_date') }}">
        </div>
        <div class="col-sm">
            <label for="filterToDateUntilInput" class="form-label">To</label>
            <input id="filterToDateUntilInput" class="form-control" type="date" name="to_date" value="{{ $request->get('to_date') }}">
        </div>
    </div>
</div>
