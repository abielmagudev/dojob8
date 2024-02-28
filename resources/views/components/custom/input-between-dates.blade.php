<div class="mb-3">
    <div class="row g-3">
        <div class="col-sm">
            <label for="fromDateInput" class="form-label">From</label>
            <input id="fromDateInput" class="form-control" type="date" name="dates[from]" value="{{ request()->input('dates.from') ?? ($from ?? '') }}">
        </div>
        <div class="col-sm">
            <label for="toDateInput" class="form-label">To</label>
            <input id="toDateInput" class="form-control" type="date" name="dates[to]" value="{{ request()->input('dates.to') ?? ($to ?? '') }}">
        </div>
    </div>
</div>
