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
        @include('members._form')
        <br>
        <div class="text-end">
            <button class="btn btn-success" type="submit">Create member</button>
            <a href="{{ route('members.index') }}" class="btn btn-primary">Cancel</a>
        </div>
    </form>
</x-card>

@endsection
