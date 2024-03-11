<?php
$settings = (object) [
    'product' => isset($product) ? $product : [
        'text' => '',
        'value' => '',
    ],
    'quantity' => isset($quantity) ? $quantity : [
        'text' => '',
        'value' => '',
    ],
    'indications' => isset($indications) ? $indications : [
        'text' => '',
        'value' => '',
    ],
];
?>
<div class="row align-items-end hover-bg-darken mb-1 py-1">
    <div class="col">
        <span class="form-control bg-transparent product">{{ $settings->product['text'] }}</span>
        <input type="hidden" name="products[]" value="{{ $settings->product['value'] }}">
    </div>
    <div class="col">
        <span class="form-control bg-transparent quantity">{{ $settings->quantity['text'] }}</span>
        <input type="hidden" name="quantities[]" value="{{ $settings->quantity['value'] }}">
    </div>
    <div class="col">
        <span class="form-control bg-transparent indications">{{ $settings->indications['text'] }}</span>
        <input type="hidden" name="indications[]" value="{{ $settings->indications['value'] }}">
    </div>
    <div class="col col-sm-2 col-md-1">
        <button class="btn btn-outline-danger fw-bold w-100" type="button">
            <b>-</b>
        </button>
    </div>
</div>
