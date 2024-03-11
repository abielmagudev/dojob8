@extends('application')
@section('header')
<x-page-title>{{ $extension->name }}</x-page-title>
@endsection

@section('content')
<h5 class="text-secondary">Example</h5>
<x-box>
    @include('BattInsulation.views.work-orders.form')
</x-box>
@endsection
