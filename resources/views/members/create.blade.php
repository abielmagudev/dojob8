@extends('application')

@section('header')
<x-header title="Members" :breadcrumbs="[
    'Back to members' => route('members.index'),
    'Create' => null,
]" />
@endsection

@section('content')
<x-card title="New member">
    <form action="{{ route('members.store') }}" method="post" autocomplete="off">
        @include('members._form')
        <br>
        <div class="text-end">
            <button class="btn btn-success" type="submit">Save member</button>
            <a href="{{ route('members.index') }}" class="btn btn-primary">Cancel</a>
        </div>
    </form>
</x-card>

@endsection
