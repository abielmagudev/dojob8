<x-modal id="modalScheduledDates" title="Work order scheduling dates" header-close>
    <form action="{{ route('dashboard.index') }}" method="get">

        <div class="input-group mb-3">
            <label for="fromDateInput" class="input-group-text text-uppercase">
                <small>From</small>
            </label>
            <input id="fromDateInput" type="date" class="form-control" name="from" value="{{ $request->get('from') }}" required>
        </div>

        <div class="input-group mb-3">
            <label for="toDateInput" class="input-group-text text-uppercase" style="width:66px">
                <small>To</small>
            </label>
            <input id="toDateInput" type="date" class="form-control" name="to" value="{{ $request->get('to') }}">
        </div>

        <button class="btn btn-primary w-100">
            <i class="bi bi-clipboard-data"></i>
            <span class="ms-1">Generate statistics</span>
        </button>
        
    </form>
</x-modal>
