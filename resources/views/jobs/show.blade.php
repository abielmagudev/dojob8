@extends('application')

@section('header')
<x-header title="{{ $job->name }}" :breadcrumbs="[
    'Back to jobs' => route('jobs.index'),
    'Job' => null,
]"></x-header>
@endsection

@section('content')
<div class="row">

    {{-- Information --}}
    <div class="col-sm mb-3">
        <x-card title="Information">
            <x-slot name="options">
                <a href="{{ route('jobs.edit', $job) }}" class="btn btn-warning">
                    <i class="bi bi-pencil-fill"></i>
                </a>
            </x-slot>
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

    {{-- Extensions --}}
    <div class="col-sm">
        <x-card title="Extensions">
            <x-slot name="options">
                @if( $extensions->count() )
                <x-modal-trigger class="btn btn-primary fw-bold px-3" modal-id="modalAddExtension">+</x-modal-trigger>

                @else
                <button class="btn btn-secondary fw-bold px-3" type="button" disabled>+</button>

                @endif
            </x-slot>

            @if( $job->hasExtensions() )
            <div class="mb-3">
                <x-table class="align-middle">
                    @foreach($job->extensions as $extension)
                    <tr>
                        <td>{{ $extension->name }}</td>
                        <td class="text-end">
                            <x-modal-trigger class="btn btn-outline-danger fw-bold px-3" modal-id="modalRemoveExtension" name="extension" :value="json_encode(['id' => $extension->id, 'name' => $extension->name])">x</x-modal-trigger>
                        </td>
                    </tr>
                    @endforeach
                </x-table>
            </div>
            @endif
        </x-card>
    </div>
</div>
@include('jobs.show.modal-add-extension')
@include('jobs.show.modal-remove-extension')
@endsection