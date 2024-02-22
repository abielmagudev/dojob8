<?php use App\Xapis\Stock\WeatherizationProductCps\Controllers\WpCpsController; ?>
<div class="my-3">
    <div class="btn-group btn-group-sm" role="group" aria-label="Subnavbar of extension">
        @foreach(WpCpsController::getSubaliases() as $sub)
        <a href="{{ route('extensions.show', [$extension, 'sub' => $sub]) }}" class="btn {{ request()->get('sub', 'products') <> $sub ? 'btn-outline-primary' : 'btn-primary' }}">{{ ucfirst($sub) }}</a>
        @endforeach
    </div>
</div>
