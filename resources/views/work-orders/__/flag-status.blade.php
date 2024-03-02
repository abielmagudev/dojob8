<?php $settings = [
    'pause' => [
        'class' => 'text-bg-info fst-italic animate__animated animate__flash animate__infinite',
    ],
    'new' => [
        'class' => 'text-primary border border-primary',
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

<div class="position-relative {{ $display ?? 'd-block' }}">
    <span class="badge text-uppercase <?= $settings[$status]['class'] ?? '' ?> <?= $class ?? '' ?>"  style="<?= $settings[$status]['style'] ?? '' ?>">
        <?= $status ?>
    </span>
    @if( isset($pending) && $pending == true )
    <span class="position-absolute top-0 start-100 translate-middle bg-warning border border-white rounded-circle" style="padding:6px">
    @endif
  </span>
</div>
