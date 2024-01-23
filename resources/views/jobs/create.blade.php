@extends('application')

@section('header')
<x-breadcrumb :items="[
    'Jobs' => route('jobs.index'),
    'Create'
]" />
<x-page-title>Jobs</x-page-title>
@endsection

@section('content')
<x-card title="New job">
    <form action="{{ route('jobs.store') }}" method="post" autocomplete="off">
        @include('jobs._form')
        <br>
        <div class="text-end">
            <button type="submit" class="btn btn-success">Create job</button>
            <a href="{{ route('jobs.index') }}" class="btn btn-primary">Cancel</a>
        </div>
    </form>
</x-card>
@endsection
