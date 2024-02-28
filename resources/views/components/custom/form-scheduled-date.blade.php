<form action="{{ $url }}" method="get" autocomplete="off">
    <input type="date" class="form-control" onchange="this.closest('form').submit()" name="scheduled_date" value="{{ request()->get('scheduled_date') ?? ($default ?? '') }}">
</form>
