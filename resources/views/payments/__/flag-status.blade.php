<?php $settings = [
    'free' => 'text-bg-secondary',
    'paid' => 'text-bg-success',
    'unpaid' => 'text-bg-warning animate__animated animate__pulse animate__infinite fst-italic',
] ?>
<span class="badge text-uppercase {{ $settings[$status] }} {{ $class ?? '' }} ">
    {{ $status }}
</span>
