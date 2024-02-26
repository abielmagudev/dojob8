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
@include('dashboard.admin.index.quantities')
<br>
@include('dashboard.admin.index.statuses')
<br>
@include('dashboard.admin.index.inspections')
<br>
@include('dashboard.admin.index.jobs')
<br>

@include('dashboard.admin.index.modal-scheduled-dates')
@endsection
