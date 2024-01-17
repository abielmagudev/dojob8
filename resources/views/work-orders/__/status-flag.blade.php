<?php

$settings = [
    'pending' => [
        'class' => 'text-bg-warning animate__animated animate__tada animate__infinite',
    ],
    'new' => [
        'class' => 'text-bg-primary',
    ],
    'working' => [
        'class' => 'fst-italic text-white animate__animated animate__pulse animate__infinite',
        'style' => 'background-color:#FF5B2E', // Orange: FF5B2E, Purple: 712f79
    ],
    'done' => [
        'class' => 'fst-italic text-bg-success animate__animated animate__pulse animate__infinite',
    ],
    'completed' => [
        'class' => 'text-bg-success',
    ],
    'inspected' => [
        'class' => 'bg-light text-success',
    ],
    'closed' => [
        'class' => 'text-bg-dark',
    ],
    'canceled' => [
        'class' => 'text-bg-danger',
    ],
    'denialed' => [
        'class' => 'text-bg-danger',
    ],
];

?>
<span class="badge text-uppercase {{ $settings[$status]['class'] ?? '' }} {{ $class ?? '' }}" style="{{ $settings[$status]['style'] ?? '' }}">
    {{ $status }}
</span>
