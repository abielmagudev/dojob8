@section('header')

<div class="d-flex justify-content-between">
    <div>
        @isset($pretitle)       
        <div class="small text-secondary">{{ $pretitle }}</div>
        @endisset
        
        @isset($title)
        <h2 class="mb-0">{!! $title !!}</h2>

        @else
        {!! $slot !!}
            
        @endisset

        @isset($subtitle)       
        <p class="small">{{ $subtitle }}</p>
        @endisset

        @isset($breadcrumbs)       
        <nav aria-label="breadcrumb" style="--bs-breadcrumb-divider: url(&quot;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&quot;);">
            <ol class="breadcrumb text-secondary m-0">
                @foreach($breadcrumbs as $breadcrumb => $route)
                    @if(! $loop->last )
                    <li class="breadcrumb-item">
                        <small>
                            <a href="{{ isset($route) ? $route : '#!' }}" class="text-decoration-none">{{ $breadcrumb  }}</a>
                        </small>
                    </li>
                        
                    @else
                    <li class="breadcrumb-item" aria-current="page">
                        <small>{{ $breadcrumb  }}</small>
                    </li>
        
                    @endif
                @endforeach
            </ol>
        </nav>
        @endisset 
        
    </div>

    @isset($options)
    <div>{!! $options !!}</div>
    @endisset
</div>

@endsection
