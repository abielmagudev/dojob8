@extends('application')

@section('header')
<x-breadcrumb :items="[
    'Contractors' => route('contractors.index'),
    'Contractor',
]" />
<x-page-title>
    {{ $contractor->name }} ({{ $contractor->alias }})
</x-page-title>
@endsection

@section('content')
<div class="row" class="mb-3">
    <div class="col-sm mb-3">
        @include('contractors.show.information')
    </div>

    <div class="col-sm mb-3">
        @include('contractors.show.user-accounts')
    </div>
</div>

@include('contractors.show.work-orders')
@endsection
