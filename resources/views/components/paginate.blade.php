<div class="btn-group {{ $attributes->get('class', '') }}">
    <a href="{{ $attributes->get('previous') ?? '#!' }}" class="btn btn-primary {{ $attributes->get('previous') ?: 'disabled' }}">
        <i class="bi bi-caret-left-fill"></i>
    </a>
    <a href="{{ $attributes->get('next') ?? '#!' }}" class="btn btn-primary {{ $attributes->get('next') ?: 'disabled' }}">
        <i class="bi bi-caret-right-fill"></i>
    </a>
</div>
