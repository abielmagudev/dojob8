@extends('application')

@section('header')
<x-header :title="$member->full_name" :breadcrumbs="[
    'Back to members' => route('members.index'),
    'Member' => null
]" />
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
