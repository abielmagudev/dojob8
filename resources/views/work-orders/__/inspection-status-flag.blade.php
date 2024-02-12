<?php $settings = [
    'inspected' => 'text-bg-success',
    'uninspected' => 'text-bg-warning',
    'non-inspectable' => 'text-bg-secondary',
] ?>
<span class="badge {{ $settings[$status] }} text-uppercase">{{ $status }}</span>
