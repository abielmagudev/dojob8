@section('header')
<div>
    @isset($pretitle)       
    <div class="small text-secondary">{{ $pretitle }}</div>
    @endisset

    <div class="d-flex justify-content-between  align-items-center">
        {{-- Left --}}
        <div>
            @isset($title)
            <h2 class="mb-0">{!! $title !!}</h2>
    
            @else
            {!! $slot !!}
                
            @endisset
        </div>

        {{-- Right --}}
        @isset($options)
        <div>
            {!! $options !!}
        </div>
        @endisset
    </div>

    @isset($subtitle)       
    <div class="mb-3">{{ $subtitle }}</div>
    @endisset

    @isset($breadcrumbs)       
    <div class="mb-3">
        <x-breadcrumbs :list="$breadcrumbs"/>
    </div>
    @endisset 
</div>
@endsection
