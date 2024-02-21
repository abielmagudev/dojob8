<?php $settings = [
    'pending' => [
        'class' => 'text-bg-warning animate__animated animate__pulse animate__infinite fst-italic',
    ],
    'pause' => [
        'class' => 'text-primary border border-primary fst-italic',
    ],
    'new' => [
        'class' => 'text-bg-primary',
    ],
    'working' => [
        'class' => 'text-warning border border-warning',
        // 'style' => 'background-color:#FF6624', // Orange
    ],
    'done' => [
        'class' => 'text-success border border-success',
    ],
    'completed' => [
        'class' => 'text-bg-success',
    ],
    'canceled' => [
        'class' => 'text-danger border border-danger',
    ],
    'denialed' => [
        'class' => 'text-bg-danger',
    ],
]; ?>
<span 
    class="badge text-uppercase {{ $settings[$status]['class'] ?? '' }} {{ $class ?? '' }}"
    
    @isset($settings[$status]['style'])   
    style="<?= $settings[$status]['style'] ?>"
    @endisset
>
    {{ $status }}
</span>
