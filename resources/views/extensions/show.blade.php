@extends('application')
@section('content')
@if(! is_null($content) )
    {!! $content !!}

@else
    <p class="lead text-center">{{ $extension->name }} not has configuration</p>

@endif
@endsection
