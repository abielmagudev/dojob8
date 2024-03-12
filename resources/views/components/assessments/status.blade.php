<?php

$colors = [
    'new' => 'border text-bg-primary ',
    'working' => 'border text-bg-warning',
    'done' => 'border text-bg-success',
    'denialed' => 'border text-bg-danger',
    'canceled' => 'border border-danger text-danger',
];

?>

<span class="badge text-uppercase {{ $colors[$value] }}">{{ $value }}</span>
