@extends('application')
<x-header subheader="Jobs">
    {{ $job->name }}
</x-header>
@section('content')
<div class="row">
    <div class="col">
        <x-card title="Information">
            <p>
                <small class="text-body-secondary">Description</small>
                <br>
                <span>{{ $job->description ?? 'Without description' }}</span>
            </p>
            <p>
                <small class="text-body-secondary">Successful inspections</small>
                <br>
                <span>{{ $job->successful_inspections }}</span>
            </p>
        </x-card>
    </div>
    <div class="col">
        <x-card title="Extensions">
            ...
        </x-card>
    </div>
</div>
@endsection