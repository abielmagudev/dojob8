@extends('application')

@section('header')
<x-page-title>
    Dashboard

    <x-slot name="subtitle">
        {{ $subtitle }}
        <br>
        <x-modal-trigger modal-id="modalScheduledDates" class="text-decoration-none small" link>
            <i class="bi bi-calendar-range d-none"></i>
            <span>Change scheduling dates</span>
        </x-modal-trigger>
    </x-slot>

</x-page-title>
@endsection

@section('content')
@include('dashboard.index.quantities')
<br>
@include('dashboard.index.statuses')
<br>
@include('dashboard.index.inspections')
<br>
@include('dashboard.index.jobs')
<br>

@include('dashboard.index.modal-scheduled-dates')
@endsection
