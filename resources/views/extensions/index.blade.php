@extends('application')

@section('header')
<x-header title="Extensions" />
@endsection

@section('content')
<x-card>
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                    @foreach($extensions as $extension)             
                    <tr>
                        <td>{{ $extension->name }}</td>
                        <td>{{ $extension->description }}</td>
                        <td class='text-end'>
                            <a class="btn btn-outline-primary" href="{{ route('extensions.show', $extension) }}">Configuration</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
        </table>
    </div>
</x-card>
@endsection
