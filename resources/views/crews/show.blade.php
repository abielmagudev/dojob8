@extends('application')

@section('header')
<x-header title="{{ $crew->name }}" :breadcrumbs="[
    'Back to crews' => route('crews.index'),
    'Crew' => null,
]" />
@endsection

@section('content')
<p>...</p>
@endsection
