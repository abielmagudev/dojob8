@extends('application')

@section('header')
<x-header title="History">
    <x-slot name="options">
        <x-paginate
            :previous="$history->previousPageUrl()"
            :next="$history->nextPageUrl()"
        />
    </x-slot>
</x-header>
@endsection

@section('content')
<x-card>

    @slot('title')
    <small class="align-middle badge text-bg-dark">{{ $history->total() }}</small>
    <span class="align-middle">Activities</span>
    @endslot

    @slot('options')
    <x-modal-trigger modal-id="historyFilterModal" class="btn btn-primary">
        <i class="bi bi-funnel"></i>
    </x-modal-trigger>
    @endslot

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
                <span>{{ $activity->user->profile->meta_name }}</span>
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
</x-card>
<br>

<x-pagination-simple-eloquent :collection="$history" />
@include('history.index.modal-filters')
@endsection
