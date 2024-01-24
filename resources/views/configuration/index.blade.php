@extends('application')

@section('header')
<x-page-title>Configuration</x-page-title>
@endsection

@section('content')
<x-card>
    @slot('options')
    <a href="{{ route('configuration.edit', $configuration) }}" class="btn btn-warning">
        <i class="bi bi-pencil-fill"></i>
    </a>
    @endslot

    <x-small-title title="Company name">
        {{ $configuration->company_name }}
    </x-small-title>
</x-card>
@endsection
