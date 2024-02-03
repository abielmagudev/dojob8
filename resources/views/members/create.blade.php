@extends('application')

@section('header')
<x-breadcrumb :items="[
    'Members' => route('members.index'),
    'Create',
]" />
<x-page-title>Members</x-page-title>
@endsection

@section('content')
<x-card title="New member">
    <form action="{{ route('members.store') }}" method="post" autocomplete="off">
        @csrf
        @include('members._form')
        <br>
        <div class="text-end">
            <a href="{{ route('members.index') }}" class="btn btn-outline-primary">Cancel</a>
            <button class="btn btn-success" type="submit">Create member</button>
        </div>
    </form>
</x-card>

@endsection
