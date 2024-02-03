@extends('application')

@section('header')
<x-page-title>Configuration</x-page-title>
@endsection

@section('content')
<x-card>
    <form action="{{ route('configuration.update', $configuration) }}" method="post" autocomplete="off">
        @method('put')
        @csrf
        @include('configuration._form')
        <br>

        <div class="text-end">
            <a href="{{ route('configuration.index') }}" class="btn btn-outline-primary me-1">Cancel</a>
            <button type="submit" class="btn btn-warning">Update configuration</button>
        </div>
    </form>
</x-card>
@endsection
