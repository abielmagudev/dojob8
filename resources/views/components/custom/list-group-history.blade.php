<ul class="list-group list-group-flush">
    @foreach($attributes->get('history') as $activity)
    <li class="list-group-item">
        <div class="mb-1">
            @if( in_array('description', $attributes->get('only', [])) ||! in_array('description', $attributes->get('except', [])) )
            {!! $activity->description !!}
            @endif

            <small class="d-block">
                @if( in_array('created_at', $attributes->get('only', [])) ||! in_array('created_at', $attributes->get('except', [])) )
                <span>{{ $activity->created_at }}</span>
                @endif

                @if( in_array('user', $attributes->get('only', [])) ||! in_array('user', $attributes->get('except', [])) )
                <span>by {{ $activity->user->name }}</span>
                @endif
            </small>             
        </div>

        @if( $activity->hasLink() )
        @if( in_array('link', $attributes->get('only', [])) ||! in_array('link', $attributes->get('except', [])) )
        <small>
            <a href="{{ $activity->link }}">See changes</a>
        </small>
        @endif
        @endif
    </li>
    @endforeach
</ul>
