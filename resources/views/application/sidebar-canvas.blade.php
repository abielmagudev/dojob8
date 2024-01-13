<?php $config = include( resource_path('views/application/config-menu.blade.php') ) ?>

<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasSidebarMenu" aria-labelledby="offcanvasSidebarMenuLabel">
    <div class="offcanvas-header">
        <div class="lh-1">
            <h5 class="offcanvas-title" id="offcanvasSidebarMenuLabel">Dojob</h5>
            <small>{{ now()->toFormattedDayDateString() }}</small>
        </div>
        <button type="button" class="btn-close xbtn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        @foreach($config as $header => $menu)
        <div class="mb-3">
            <small class="text-uppercase text-secondary">{{ $header }}</small>
            <div class="list-group list-group-flush">
                @foreach($menu as $title => $item)               
                <a href="{{ $item['route'] }}" class="list-group-item list-group-item-action rounded border-0 {{ $item['active'] ? 'active' : '' }}">
                    {!! $item['icon'] !!}
                    <span class="ms-2">{{ $title }}</span>
                </a>
                @endforeach
            </div>
        </div>
        @endforeach
    </div>
</div>
