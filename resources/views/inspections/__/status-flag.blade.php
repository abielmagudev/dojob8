<?php $settings = [
    'failed' => 'text-bg-danger',
    'on hold' => 'text-bg-primary',
    'passed' => 'text-bg-success',
    'pending' => 'bg-warning text-danger animate__animated animate__tada animate__infinite',
] ?>
<span class="badge text-uppercase {{ isset($settings[$status]) ? $settings[$status] : '' }} {{ $class ?? '' }}">
    {{ $status }}
</span>
