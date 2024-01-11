<?php $menu = include( resource_path('views/application/config-menu.blade.php')) ?>

<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasSidebarMenu" aria-labelledby="offcanvasSidebarMenuLabel">
    <div class="offcanvas-header">
        <div class="lh-1">
            <h5 class="offcanvas-title" id="offcanvasSidebarMenuLabel">Dojob</h5>
            <small>{{ now()->toFormattedDayDateString() }}</small>
        </div>
        <button type="button" class="btn-close xbtn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <ul class="nav nav-pills flex-column">
            @foreach($menu as $title => $config)
            <li class="nav-item">
                
                <a href="{{ $config['route'] }}" class="nav-link {{ $config['active'] ? 'active' : '' }}">
                    {!! $config['icon'] !!}
                    <span class="ms-2">{{ $title }}</span>
                </a>

            </li>
            @endforeach
        </ul>
    </div>
</div>
