<?php $settings = [
    'default' => $default ?? date('Y-m-d'),
    'route' => $route,
] ?>
<form action="{{ $settings['route'] }}" method="get" autocomplete="off">
    <input type="date" class="form-control" onchange="this.closest('form').submit()" name="scheduled_date" value="{{ $request->get('scheduled_date', $settings['default']) }}">
</form>
