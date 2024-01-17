<?php $settings = [
    'failed' => [
        'class' => 'text-bg-danger',
    ],
    'on hold' => [
        'class' => 'text-bg-primary',
    ],
    'passed' => [
        'class' => 'text-bg-success',
    ],
    'pending' => [
        'class' => 'text-bg-warning animate__animated animate__tada animate__infinite',
        // 'style' => 'background-color:#f15025', // Orange: f15025, Purple: 712f79
    ],
] ?>
<span 
    class="badge text-uppercase {{ isset($settings[$status]['class']) ? $settings[$status]['class'] : '' }} {{ $class ?? '' }}"
    style="{{ isset($settings[$status]['style']) ? $settings[$status]['style'] : '' }}"
>
    {{ $status }}
</span>
