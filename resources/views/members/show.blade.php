@extends('application')

@section('header')
<x-breadcrumb :items="[
    'Members' => route('members.index'),
    'Member'
]" />
<x-page-title>{{ $member->full_name }}</x-page-title>
@endsection

@section('content')
    @include('members.show.information')
@endsection
