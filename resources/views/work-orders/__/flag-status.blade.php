<?php $settings = [
    'pending' => [
        'class' => 'text-dark bg-warning animate__animated animate__pulse animate__infinite fst-italic',
        'text' => 'Pending!',
    ],
    'pause' => [
        'class' => 'text-bg-primary fst-italic',
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
<span 
class="badge text-uppercase <?= $settings[$status]['class'] ?? '' ?> <?= $class ?? '' ?>"
style="<?= $settings[$status]['style'] ?? '' ?>"
>
    <?= $settings[$status]['text'] ?? $status ?>
</span>
