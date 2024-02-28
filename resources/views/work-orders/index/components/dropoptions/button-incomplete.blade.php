<a href="<?= $filtering['incomplete']['url'] ?? '#!' ?>" class="dropdown-item">
    <div class="d-flex justify-content-between">
        <div class="me-3">
            <i class="bi bi-exclamation-triangle"></i>
            <span class="ms-1">Incomplete</span>
        </div>
        <div class="float-end">
            <span class="badge border border-warning text-warning">{{ $filtering['incomplete']['count'] ?? 0 }}</span>
        </div>
    </div>
</a>
