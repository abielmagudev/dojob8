@extends('application')

@section('header')
<x-header title="{{ $job->name }}" :breadcrumbs="[
    'Back to jobs' => route('jobs.index'),
    'Job' => null,
]">
    <x-slot name="options">
        <?php 
        $before = $job->before();
        $after  = $job->after();
        ?>
        <x-paginate
            :previous="$before ? route('jobs.show', $before) : false"
            :next="$after ? route('jobs.show', $after) : false"
        />
    </x-slot>
</x-header>
@endsection

@section('content')
<div class="row">

    <div class="col-md col-md-4 mb-3">
        @include('jobs.show.information')
    </div>

    <div class="col-md">
        @include('jobs.show.extensions')
    </div>
</div>

@include('jobs.show.modal-add-extension')
@include('jobs.show.modal-remove-extension')

@endsection
