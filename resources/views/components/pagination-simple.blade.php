<div class="d-flex justify-content-end align-items-center">
    <ul class="pagination shadow-sm rounded me-3">
        <li class="page-item {{ $collection->previousPageUrl() ? '' : 'disabled' }}">
            <a class="page-link border-0" href="{{ $collection->previousPageUrl() ?? '#!' }}" aria-label="Previous">
                <span>Previous</span>
            </a>
        </li>
        <li class="page-item {{ $collection->nextPageUrl() ? '' : 'disabled' }}">
            <a class="page-link border-0" href="{{ $collection->nextPageUrl() ?? '#!' }}" aria-label="Next">
                <span>Next</span>
            </a>
        </li>
    </ul>
    <ul class="pagination shadow-sm rounded">
        <li class="page-item disabled ">
            <a class="page-link border-0 text-secondary bg-white" href="#!" aria-label="Current page">
                Page {{ request('page', '1') }}
            </a>
        </li>
    </ul>
</div>
