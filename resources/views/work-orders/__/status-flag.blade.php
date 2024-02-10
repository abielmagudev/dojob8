<?php $settings = [
    'pause' => [
        'class' => 'text-bg-info animate__animated animate__tada animate__infinite fst-italic',
    ],
    'new' => [
        'class' => 'text-bg-primary',
    ],
    'working' => [
        'class' => 'text-bg-warning',
        // 'style' => 'background-color:#FF6624', // Orange
    ],
    'done' => [
        'class' => 'text-bg-success',
    ],
    'completed' => [
        'class' => 'text-success border border-success',
    ],
    'canceled' => [
        'class' => 'text-danger border border-danger',
    ],
    'denialed' => [
        'class' => 'text-bg-danger',
    ],
]; ?>
<span 
    class="badge text-uppercase {{ $settings[$status]['class'] ?? '' }}" 
    style="{{ $settings[$status]['style'] ?? '' }}"
>
    {{ $status }}
</span>
