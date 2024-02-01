<div class="is-sortable-item {{ $class ?? '' }}" style="cursor:move">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <span class="me-1">
                <i class="bi bi-person-bounding-box"></i>
            </span>
            <span>
                {{ $member->full_name }}
            </span>     
        </div>
        <div class="ms-3">
            <button class="btn btn-outline-danger btn-sm border-0 py-0 px-1 remove-member-button" type="button">
                <i class="bi bi-x"></i>
            </button>
        </div>
    </div>
    <input type="hidden" name="members[]" value="{{ $member->id }}">
</div>
