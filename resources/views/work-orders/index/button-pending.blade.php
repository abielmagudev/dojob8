<a href="<?= $filtering['pending']['url'] ?? '#!' ?>" class="dropdown-item">
    <div class="d-flex justify-content-between">
        <div class="me-3">
            <i class="bi bi-question-diamond"></i>
            <span class="ms-1">Pending</span>
        </div>
        <div class="float-end">
            <span class="badge border border-warning text-warning">{{ $filtering['pending']['count'] ?? 0 }}</span>
        </div>
    </div>
</a>
