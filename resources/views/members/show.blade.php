@extends('application')

@section('header')
<x-breadcrumb :items="[
    'Members' => route('members.index'),
    'Member'
]" />
<x-page-title>{{ $member->full_name }}</x-page-title>
@endsection

@section('content')
<div class="row">
    <div class="col-lg col-lg-4 mb-3">
        @include('members.show.information')
    </div>
    <div class="col-lg col-lg-8 mb-3">
        @include('members.show.crews')
    </div>
</div>
@endsection
