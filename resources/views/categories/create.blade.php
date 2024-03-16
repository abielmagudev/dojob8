@extends('application')

@section('header')
<x-page-title>Categories</x-page-title>
@endsection

@section('content')
<x-card title="New category">
    <form action="{{ route('categories.store') }}" method="post" autocomplete="off">
        @csrf
        @include('categories.inc.form')
        <br>

        <div class="d-flex justify-content-end gap-2">
            <a href="{{ route('categories.index') }}" class="btn btn-dark">Cancel</a>
            <button type="submit" class="btn btn-success">Create category</button>
        </div>
    </form>
</x-card>
@endsection
