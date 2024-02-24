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
    'pending' => [
        'class' => 'text-bg-warning animate__animated animate__pulse animate__infinite fst-italic',
        // 'style' => 'background-color:#f15025', // Orange: f15025, Purple: 712f79
        // 'text' => 'Pending!',
    ],
] ?>
<span 
class="badge text-uppercase <?= $settings[$status]['class'] ?? '' ?> <?= $class ?? '' ?>"
style="<?= $settings[$status]['style'] ?? '' ?>"
>
    <?= $settings[$status]['text'] ?? $status ?>
</span>
