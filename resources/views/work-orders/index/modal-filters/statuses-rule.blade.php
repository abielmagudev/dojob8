{{-- Status --}}
<?php $status_rules = ['only', 'except'] ?>
<div class="mb-3">
    <label for="filterStatusRuleSelect" class="form-label">Status</label>

    <select id="filterStatusRuleSelect" class="form-select text-capitalize mb-1" name="status_rule">
        <option label="Any status" selected></option>

        @foreach($status_rules as $rule)
        <option value="{{ $rule }}" {{ isSelected($rule == $request->get('status_rule')) }}>{{ $rule }}...</option>
        @endforeach

    </select>

    <div id="statusGroupWrapper" class="rounded bg-light pt-1 px-3 pb-3 mx-2 {{ in_array($request->get('status_rule'), $status_rules) ? 'd-block' : 'd-none' }}">
        <div class="d-flex justify-content-between mb-1">
            <small>
                <a href="#!" class="d-none">Clear</a>
            </small>
            <small>
                <span class="text-secondary">Scroll down or up</span>
            </small>
        </div>
        <div class="overflow-y-scroll border rounded" style="height:156px">
            <ul id="statusGroupList" class="list-group list-group-flush">
                @foreach($all_statuses as $status)
                <?php $checkbox_id = "checkboxStatus" . ucfirst($status) ?>
                <li class="list-group-item list-group-item-action">
                    <div class="form-check">
                        <input id="{{ $checkbox_id }}" class="form-check-input" type="checkbox" name="status_group[]" value="{{ $status }}" {{ isChecked( in_array($status, $request->get('status_group', [])) ) }}>
                        <label for="{{ $checkbox_id }}" class="form-check-label text-capitalize">{{ $status }}</label>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

@push('scripts')
<script>

const filterStatusRuleSelect = {
    element: document.getElementById('filterStatusRuleSelect'),
    listen: function () {
        this.element.addEventListener('change', function (evt) {
            statusGroupList.toggle( !['only', 'except'].includes(this.value) )
        })
    }
}

const statusGroupList = {
    element: document.getElementById('statusGroupWrapper'),
    toggle: function (switcher) {
        this.element.classList.toggle('d-none', switcher)
    }
}

filterStatusRuleSelect.listen()

</script>
@endpush
