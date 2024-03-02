<?php $settings = [
    'awaiting' => [
        'class' => 'text-primary border border-primary',
    ],
    'failed' => [
        'class' => 'text-bg-danger',
    ],
    'success' => [
        'class' => 'text-bg-success',
    ],
] ?>
<span 
class="badge text-uppercase <?= $settings[$status]['class'] ?? '' ?> <?= $class ?? '' ?>"
style="<?= $settings[$status]['style'] ?? '' ?>"
>
    <?= $settings[$status]['text'] ?? $status ?>
</span>
