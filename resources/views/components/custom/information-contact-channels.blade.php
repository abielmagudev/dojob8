<div class="{{ $attributes->get('class', '') }}">
@foreach($channels as $key => $value)

    <?php $settings = [
        'item-class' => $attributes->get('item-class', ''),
        'link-class' => $attributes->get('link-class', 'text-decoration-none'),
        'prefix' => $key <> 'email' ? 'tel' : 'mailto',
        'title' => \Illuminate\Support\Str::title($key),
        'type' => $attributes->get('type', 'default'),
    ] ?>

    <div class="{{ $settings['item-class'] }}">
    
        @if( $settings['type'] == 'tooltip' )
        <x-tooltip title="{{ $settings['title'] }}">
            <a href="{{ $settings['prefix'] }}:{{ $value }}" class="{{ $settings['link-class'] }}">{{ $value }}</a>
        </x-tooltip>
    
        @elseif( $settings['type'] == 'tag' )
        <x-tag-addon addon="{{ $settings['title'] }}" bordered rounded>
            <a href="{{ $settings['prefix'] }}:{{ $value }}" class="{{ $settings['link-class'] }}">{{ $value }}</a>
        </x-tag-addon>
    
        @else
        <span class="text-capitalize">{{ $settings['title'] }}</span>
        <a href="{{ $settings['prefix'] }}:{{ $value }}" class="{{ $settings['link-class'] }}">{{ $value }}</a>
        
        @endif
    </div>

@endforeach
</div>
