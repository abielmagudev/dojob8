{{-- Scheduled date range --}}
<div class="mb-3">
    <div class="row g-3">
        <div class="col-sm">
            <label for="filterScheduledDateFromInput" class="form-label">Scheduled from</label>
            <input id="filterScheduledDateFromInput" class="form-control" type="date" name="scheduled_date_range[]" value="{{ $request->input('scheduled_date_range.0', now()->format('Y-01-01')) }}">
        </div>
        <div class="col-sm">
            <label for="filterScheduledDateUntilInput" class="form-label">Scheduled until</label>
            <input id="filterScheduledDateUntilInput" class="form-control" type="date" name="scheduled_date_range[]" value="{{ $request->input('scheduled_date_range.1', now()->format('Y-m-d')) }}">
        </div>
    </div>
</div>
