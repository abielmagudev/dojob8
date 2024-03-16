<!-- Trigger -->
<x-modal-trigger modal-id="editQuicklyModal" class="dropdown-item">
    <i class="bi bi-pencil-square"></i>
    <span class="ms-1">Edit quickly</span>
</x-modal-trigger>

<!-- Modal -->
@push('end')
<x-modal id="editQuicklyModal" title="Edit quickly selected work orders" header-close>

    <form action="{{ route('work-orders.update.quickly', 'status') }}" method="post" autocomplete="off" id="workOrderStatusUpdateForm">
        @method('patch')
        @csrf
        <label for="statusSelect" class="form-label d-none">Status</label>
        <div class="row g-3">
            <div class="col-sm mb-3 mb-md-0">
                <select id="statusSelect" class="form-select" name="status" required>
                    <option disabled selected label="Choose..."></option>

                    @foreach($all_statuses as $status)
                    <option value="{{ $status }}">{{ title($status) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm col-sm-5 text-end">
                <button class="btn btn-warning w-100" type="submit">Update status</button>
            </div>
        </div>
        <input type="hidden" name="url_back" value="{{ $request->fullUrl() }}">
    </form>

    <hr class="my-4">

    <form action="{{ route('work-orders.update.quickly', 'schedule') }}" method="post" autocomplete="off" id="workOrderScheduleUpdateForm">
        @method('patch')
        @csrf
        <label for="statusSelect" class="form-label d-none">Schedule</label>
        <div class="row g-3">
            <div class="col-sm mb-3 mb-md-0">
                <input type="date" class="form-control" name="scheduled_date" required>
            </div>
            <div class="col-sm col-sm-5 text-end">
                <button class="btn btn-warning w-100" type="submit">Change schedule</button>
            </div>
        </div>
        <input type="hidden" name="url_back" value="{{ $request->fullUrl() }}">
    </form>
    <br>

</x-modal>
@endpush

@push('scripts')
<script>
const workOrderCheckboxes = {
    elements: document.querySelectorAll('input[type="checkbox"][name^="work_orders"]'),
    changeFormId: function ($form_id) {
        this.elements.forEach(function (checkbox) {
            checkbox.setAttribute('form', $form_id)
        })

        return true;
    },
}

const editQuicklyModal = {
    modal: document.getElementById('editQuicklyModal'),
    triggers: function () {
        return this.modal.querySelectorAll('button[type="submit"]');
    },  
    checkboxes: function () {
    },
    listen: function () {
        let self = this

        this.triggers().forEach(function (button) {
            button.addEventListener('click', function (evt) {
                // evt.preventDefault()

                let formClosest = this.closest('form');

                workOrderCheckboxes.changeFormId( formClosest.id );

                // formClosest.submit()
            })
        })
    }
}
editQuicklyModal.listen()
</script>    
@endpush