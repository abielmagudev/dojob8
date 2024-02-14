<x-card title="{{ $history->total() }} Activities">
    <ul class="list-group list-group-flush">
        @foreach($history as $activity)   
        <li class="list-group-item">
            <span class="d-block mb-1">{!! $activity->description !!}</span>
            <small class="d-block text-secondary">{{ $activity->created_date_human }}, {{ $activity->created_time_human }} by {{ $activity->user->name }}</small>
        </li>
        @endforeach
    </ul> 
</x-card>
