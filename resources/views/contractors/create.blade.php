@extends('application')

@section('header')
<x-breadcrumb :items="[
    'Contractors' => route('contractors.index'),
    'Create'
]" />
<x-page-title>Contractors</x-page-title>
@endsection

@section('content')
<x-card title="New contractor">
    <form action="{{ route('contractors.store') }}" method="post" autocomplete="off">
        @csrf
        @include('contractors._form')
        <br>

        <div class="text-end">
            <a href="{{ route('contractors.index') }}" class="btn btn-outline-primary">Cancel</a>
            <button type="submit" class="btn btn-success">Create contractor</button>
        </div>
    </form>
</x-card>
@endsection
