<div class="d-flex justify-content-between align-items-center">
    <div>Page {{ request('page', '1') }}</div>
    <div>
        <ul class="pagination shadow-sm rounded m-0">
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
    </div>
</div>
