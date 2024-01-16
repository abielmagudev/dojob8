<?php

$settings = [
    'pending' => [
        'class' => 'bg-warning text-danger animate__animated animate__tada animate__infinite',
        // 'style' => 'background-color:#FF6229',
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
        'class' => 'text-bg-success animate__animated animate__pulse animate__infinite',
    ],
    'completed' => [
        'class' => 'text-bg-success fst-italic',
        // 'style' => 'background-color:#72F387; color:#333333'
    ],
    'inspected' => [
        'class' => 'text-bg-info',
        // 'style' => 'background-color:#75005D; color:#DDDDDD',
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
