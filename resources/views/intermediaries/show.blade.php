@extends('application')

@section('header')
<x-header title="{{ $intermediary->name }} ({{ $intermediary->alias }})" :breadcrumbs="[
    'Back to intermediaries' => route('intermediaries.index'),
    'Intermediary' => null,
]" />
@endsection

@section('content')
<x-card title="Information">
    <x-slot name="options">
        <a href="{{ route('intermediaries.edit', $intermediary) }}" class="btn btn-warning">
            <i class="bi bi-pencil-fill"></i>
        </a>
    </x-slot>

    <div class="row">
        <div class="col-sm">
            <h6 class="card-title">Contact</h6>
            <table class="table table-borderless">
                <tr>
                    <td style="width:1%">
                        <i class="bi bi-person"></i>
                    </td>
                    <td>
                        <div>{{ $intermediary->contact }}</div>
                    </td>
                </tr>
                <tr>
                    <td style="width:1%">
                        <i class="bi bi-envelope"></i>
                    </td>
                    <td>
                        <div>{{ $intermediary->email }}</div>
                    </td>
                </tr>
                <tr>
                    <td style="width:1%">
                        <i class="bi bi-telephone"></i>
                    </td>
                    <td>
                        <div>{{ $intermediary->phone_number }}</div>
                        <div>{{ $intermediary->mobile_number }}</div>
                    </td>
                </tr>
                <tr>
                    <td style="width:1%">
                        <i class="bi bi-geo"></i>
                    </td>
                    <td>
                        <div>{{ $intermediary->street }}</div>
                        <div>{{ $intermediary->location }}</div>
                    </td>
                </tr>
            </table>
        </div>

        <div class="col-sm">
            <h6 class="card-title">Notes</h6>
            <p>
                <em>{{ $intermediary->notes }}</em>
            </p>
        </div>
    </div>

</x-card>
<br>

<x-card title="Orders">
            
</x-card>
@endsection
