@extends('application')

@section('header')
<x-breadcrumb :items="[
    'Back to Staff' => route('members.index'),
    'Member'
]" />
<x-page-title>{{ $member->full_name }}</x-page-title>
@endsection

@section('content')
<div class="row">
    <div class="col-md col-md-4">
        @include('members.show.information')
    </div>
    <div class="col-md">
        @include('members.show.crew')
    </div>
</div>
@endsection
