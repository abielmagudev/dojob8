@extends('application')

@section('header')
<x-breadcrumb :items="[
    'Inspectors' => route('inspectors.index'),
    'Inspector'
]" />
<x-page-title>
    <div class="float-end">
        <a href="{{ route('inspectors.edit', $inspector) }}" class="btn btn-warning">
            <i class="bi bi-pencil-fill"></i>
        </a>
    </div>

    {{ $inspector->name }}

    @if( $inspector->hasNotes() )     
        @slot('subtitle')
            <b>Notes:</b>
            {{ $inspector->notes }}
        @endslot
    @endif
</x-page-title>
@endsection

@section('content')
@include('inspectors.show.inspections')
@endsection
