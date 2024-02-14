@extends('application')

@section('header')
<x-page-title>Settings</x-page-title>
@endsection

@section('content')
<x-card>
    <form action="{{ route('settings.update', $settings) }}" method="post" autocomplete="off">
        @method('patch')
        @csrf
        @include('settings._form')
        <br>

        <div class="text-end">
            <a href="{{ route('settings.index') }}" class="btn btn-outline-primary me-1">Cancel</a>
            <button type="submit" class="btn btn-warning">Update settings</button>
        </div>
    </form>
</x-card>
@endsection
