<?php $settings = [
    'failed' => [
        'class' => 'text-bg-danger',
    ],
    'awaiting' => [
        'class' => 'text-primary border border-primary',
    ],
    'approved' => [
        'class' => 'text-bg-success',
    ],
] ?>
<span 
class="badge text-uppercase <?= $settings[$status]['class'] ?? '' ?> <?= $class ?? '' ?>"
style="<?= $settings[$status]['style'] ?? '' ?>"
>
    <?= $settings[$status]['text'] ?? $status ?>
</span>
