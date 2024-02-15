@extends('application')

@section('header')
<x-page-title>History</x-page-title>
@endsection

@section('content')
<x-card title="{{ $history->total() }} activities">

    @slot('options')
    <x-modal-trigger modal-id="historyFilterModal" class="btn btn-outline-primary">
        <i class="bi bi-filter"></i>
    </x-modal-trigger>
    @endslot

    @if( $history->count() )
    <x-table class="align-middle">
        <x-slot name="thead">
            <tr>
                <th>Activity</th>
                <th>By</th>
                <th>At</th>
            </tr>
        </x-slot>

        @foreach($history as $activity)
        <tr>
            <td style="min-width:200px">   
                {!! $activity->description !!}

                @if( $activity->hasLink() )
                <small>
                    <a href="{{ $activity->link }}">See changes</a>
                </small>
                @endif   
            </td>
            <td>
                <span>{{ $activity->user->profile_name }}</span>
                <span>-</span>
                <em>{{ $activity->user->name }}</em>
            </td>
            <td>
                <span class="me-1">{{ $activity->created_date_human }}</span>
                <span>{{ $activity->created_time_human }}</span>
            </td>

        </tr>
        @endforeach
    </x-table>
    @endif
</x-card>
<br>

<div class="px-3">
    <x-pagination-simple-model :collection="$history" />
</div>

@include('history.index.modal-filtering')
@endsection
