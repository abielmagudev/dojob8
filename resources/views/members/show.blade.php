@extends('application')

@section('header')
<x-header :title="$member->full_name" :breadcrumbs="[
    'Back to staff' => route('members.index'),
    'Member' => null
]">
    <x-slot name="options">
        <x-paginate 
            :previous="$routes['previous']" 
            :next="$routes['next']" 
        />
    </x-slot>
</x-header>
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
