<?php use App\Xapis\Stock\WeatherizationCps\Controllers\XapiController; ?>

<div class="text-center">
    <div class="btn-group btn-group-sm mb-3" role="group" aria-label="Subnavbar of extension">
        @foreach(XapiController::getSubaliases() as $sub)
        <a href="{{ route('extensions.show', [$extension, 'sub' => $sub]) }}" class="btn {{ request()->get('sub', 'products') <> $sub ? 'btn-primary' : 'btn-primary disabled' }}">{{ ucfirst($sub) }}</a>
        @endforeach
    </div>
</div>
