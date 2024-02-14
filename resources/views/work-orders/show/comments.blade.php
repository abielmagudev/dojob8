<x-card title="{{ $comments->count() }}">

    {{-- OPTIONS --}}
    <x-slot name="options">
        <x-modal-trigger modal-id="modalCreateComment">
            <i class="bi bi-plus-lg"></i>
        </x-modal-trigger>
    </x-slot>

    {{-- BODY --}}
    @if( $comments->count() )      
    <ul class="list-group list-group-flush">

        @foreach($comments as $comment)         
        <li class="list-group-item">
            <small>{{ $comment->user->name }}:</small>
            <div>
                <em>{{ $comment->content }}</em>
            </div>
            <small class="text-secondary">{{ $comment->created_date_human }}, {{ $comment->created_time_human }}</small>
        </li>
        @endforeach

    </ul> 
    @endif

</x-card>

<x-modal id="modalCreateComment" title="Comment on work order {{ $work_order->id }}" header-close>
    <form action="{{ route('comments.create', $work_order) }}" method="post" id="formStoreComment">
        @csrf
        <div class="mb-3">
            <label for="commentTextarea" class="form-label">Write your comment</label>
            <textarea id="commentTextarea" rows="5" class="form-control" name="comment" required></textarea>
        </div>
    </form>

    <x-slot name="footer">
        <x-modal-button-close>Cancel</x-modal-button-close>
        <button class="btn btn-success" form="formStoreComment">Save comment</button>
    </x-slot>
</x-modal>
