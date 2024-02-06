@extends('application')
@section('header')
    <x-page-title>Agencies</x-page-title>
@endsection
@section('content')
    <x-card title="New agency">
        <form action="{{ route('agencies.store') }}" method="post" autocomplete="off">
            @csrf
            @include('agencies._form')
            <br>

            <div class="text-end">
                <a href="{{ route('agencies.index') }}" class="btn btn-outline-primary">Cancel</a>
                <button class="btn btn-success" type="submit">Create agency</button>
            </div>
        </form>
    </x-card>
@endsection
