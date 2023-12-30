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

    {{-- Information --}}
    <div class="col-md col-md-4 mb-3">
        <x-card title="Information">
            <x-slot name="options">
                <a href="{{ route('jobs.edit', $job) }}" class="btn btn-warning">
                    <i class="bi bi-pencil-fill"></i>
                </a>
            </x-slot>

            <p>
                <x-badge :color="$job->isAvailable() ? 'success' : 'secondary' " class="text-uppercase">{{ ucfirst($job->available_status) }}</x-badge>
            </p>

            <x-small-label label="Description">
                {{ $job->description }}
            </x-small-label>

            <x-small-label label="Approved inspections required">
                {{ $job->approved_inspections_required }}
            </x-small-label>
            
            <x-custom.small-label-hook-users :model="$job" />
        </x-card>
    </div>

    {{-- Extensions --}}
    <div class="col-md">
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
