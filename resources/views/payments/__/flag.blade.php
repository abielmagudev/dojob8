<?php $settings = [
    'unpaid' => 'text-bg-warning',
    'paid' => 'text-bg-success',
    'free' => 'text-bg-secondary',
] ?>

<span class="badge text-uppercase {{ $settings[$status] }}">{{ $status }}</span>
