<?php

$settings = [
    'pending' => [
        'class' => 'animate__animated animate__tada animate__infinite',
        'style' => 'background-color:#FF6229',
    ],
    'new' => [
        'class' => 'text-bg-primary',
    ],
    'working' => [
        'class' => 'text-bg-warning animate__animated animate__pulse animate__infinite',
    ],
    'reworking' => [
        'class' => 'text-bg-warning animate__animated animate__pulse animate__infinite',
    ],
    'done' => [
        'class' => 'text-bg-success',
    ],
    'completed' => [
        'class' => 'text-dark',
        'style' => 'background-color:#72F387'
    ],
    'inspected' => [
        'style' => 'background-color:#75005D',
    ],
    'closed' => [
        'class' => 'text-bg-dark',
    ],
    'canceled' => [
        'class' => 'text-bg-danger',
    ],
    'denialed' => [
        'class' => 'text-bg-secondary',
    ],
];

?>
<span class="badge text-uppercase {{ $settings[$status]['class'] ?? '' }} {{ $class ?? '' }}" style="{{ $settings[$status]['style'] ?? '' }}">
    {{ $status }}
</span>
