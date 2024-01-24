@extends('application')

@section('header')
<x-page-title>Extensions</x-page-title>
@endsection

@section('content')
<x-card>
    <div class="table-responsive">
        <x-table class="align-middle">
            @slot('thead')
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th></th>
            </tr>
            @endslot

            <tbody>
                @foreach($extensions as $extension)             
                <tr>
                    <td>{{ $extension->name }}</td>
                    <td>{{ $extension->description }}</td>
                    <td class='text-end'>
                        <a class="btn btn-outline-primary btn-sm" href="{{ route('extensions.show', $extension) }}">Configuration</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </x-table>
    </div>
</x-card>
@endsection
