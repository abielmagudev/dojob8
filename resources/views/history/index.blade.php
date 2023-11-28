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
<x-card title="Activities" subtitle="{{ $history->total() }}">
    <x-slot name="options">
        <x-modal-trigger modal-id="historyFilterModal" class="btn btn-light">
            <i class="bi bi-filter"></i>
        </x-modal-trigger>
    </x-slot>

    <x-table>
        <x-slot name="thead">
            <tr>
                <th>Activity</th>
                <th>Done</th>
                <th>User</th>
            </tr>
        </x-slot>

        @foreach($history as $activity)
        <tr>
            <td style="min-width:216px">
                {!! $activity->description !!}

                @if( $activity->hasLink() )
                <a href="{{ $activity->link }}">See changes</a>
                @endif
            </td>
            <td class="text-nowrap">
                <span>{{ $activity->created_date_human }}</span>
                <span>{{ $activity->created_time_human }}</span>
            </td>
            <td class="text-nowrap">
                {{ $activity->user->name }}
                <small>({{ $activity->user->profile->meta_name }})</small>
            </td>
        </tr>
        @endforeach
    </x-table>
</x-card>
<br>
<x-pagination-simple-eloquent :collection="$history" />
@include('history.index.modal-filters')
@endsection
