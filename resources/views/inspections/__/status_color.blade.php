<?php $statuses_colors = [
    'failed' => 'text-bg-danger',
    'on hold' => 'text-bg-secondary',
    'passed' => 'text-bg-success',
    'pending' => 'text-bg-warning',
] ?>
<span class="badge {{ $statuses_colors[$status] }} text-uppercase">
    {{ $status }}
</span>
