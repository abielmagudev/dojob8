@section('header')

@isset($preheader)       
<p class="{{ $attributes->get('preheader-class', 'text-secondary') }} mb-0">{{ $preheader }}</p>
@endisset

<p class="{{ $attributes->get('class', 'fs-3') }} mb-0">{{ $slot }}</p>

@isset($subheader)       
<p class="{{ $attributes->get('subheader-class', 'text-secondary') }} mb-0">{{ $subheader }}</p>
@endisset

<div class="mb-4"></div>
@endsection
