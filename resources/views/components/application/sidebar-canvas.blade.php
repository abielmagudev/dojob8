<?php $content = include( resource_path('views/components/application/menu.blade.php') ) ?>

<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasSidebarMenu" aria-labelledby="offcanvasSidebarMenuLabel">
    <div class="offcanvas-header">
        <div class="lh-1">
            <h5 class="offcanvas-title" id="offcanvasSidebarMenuLabel">{{ $settings->get('company_name') }}</h5>
            <small>{{ now()->toFormattedDayDateString() }}</small>
        </div>
        <button type="button" class="btn-close xbtn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">

        <div class="d-block d-lg-none mb-3">
            @include('components.application.search')
        </div>
        
        @foreach($content as $header => $menu)
        <div class="mb-3">

            @if( is_string($header) )
            <small class="text-uppercase text-secondary fw-light">{{ $header }}</small>
            @endif
            
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
        <br>
        
        <p class="text-end text-secondary text-uppercase small">
            <small>{{ config('app.name') }} {{ date('Y') }}</small>
        </p>
    </div>
</div>
