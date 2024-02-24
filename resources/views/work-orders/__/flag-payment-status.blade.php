<?php $settings = [
    'unpaid' => 'text-bg-warning animate__animated animate__pulse animate__infinite fst-italic',
    'paid' => 'text-bg-success',
    'free' => 'text-bg-secondary',
] ?>
<span 
class="badge text-uppercase {{ $settings[$status] }} {{ $class ?? '' }}"
>
    {{ $status }}
</span>
