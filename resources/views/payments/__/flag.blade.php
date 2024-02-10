<?php $settings = [
    'unpaid' => 'text-bg-warning',
    'paid' => 'text-bg-success',
    'free' => 'text-bg-dark',
] ?>
<span class="badge text-uppercase {{ $settings[$status] }} {{ $class ?? '' }}">{{ $status }}</span>
