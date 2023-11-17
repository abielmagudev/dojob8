<div class="btn-group">
    <a href="{{ $attributes->get('prev') ?? '#!' }}" class="btn btn-primary {{ $attributes->get('prev') ?: 'disabled' }}">
        <i class="bi bi-caret-left-fill"></i>
    </a>
    <a href="{{ $attributes->get('next') ?? '#!' }}" class="btn btn-primary {{ $attributes->get('next') ?: 'disabled' }}">
        <i class="bi bi-caret-right-fill"></i>
    </a>
</div>
