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

    <x-table>
        <x-slot name="thead">
            <tr>
                <th class="text-nowrap">Date & time</th>
                <th>Activity</th>
                <th>User</th>
            </tr>
        </x-slot>

        @foreach($history as $activity)
        <tr>
            <td class="text-nowrap">
                <span class="d-block">{{ $activity->created_date_human }}</span>
                <small>{{ $activity->created_time_human }}</small>
            </td>
            <td style="min-width:216px">   
                <div>{!! $activity->description !!}</div>

                @if( $activity->hasLink() )
                <small>
                    <a href="{{ $activity->link }}">See changes</a>
                </small>
                @endif
            </td>
            <td class="text-nowrap">
                <div>{{ $activity->user->name }}</div>
                <small>{{ $activity->user->profile->meta_name }}</small>
            </td>
        </tr>
        @endforeach
    </x-table>
</x-card>
<br>

<x-pagination-simple-eloquent :collection="$history" />
@include('history.index.modal-filters')
@endsection
