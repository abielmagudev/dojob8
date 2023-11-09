<div class="btn-group mb-3" role="group" aria-label="Basic example">
    <a href="{{ route('extensions.show', [$extension, 'concept' => 'product']) }}" class="btn btn-primary">Products</a>
    <a href="{{ route('extensions.show', [$extension, 'concept' => 'category']) }}" class="btn btn-primary">Categories</a>
    <a href="{{ route('extensions.show', [$extension, 'concept' => 'exports']) }}" class="btn btn-primary">Exports</a>
</div>
