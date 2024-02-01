<x-modal id="setWorkOrderWorkersModal" title="Set on work orders" subtitle="Add or change workers" header-close>

    <form action="{{ route('work-orders.update.workers', ['template' => $template]) }}" method="post" autocomplete="off" id="formSetCrewMembersOnWorkOrders">
        @method('patch')
        @csrf
        <div class="mb-2">
            <label for="scheduledDateInput" class="form-label">Schedule</label>
            <input id='scheduledDateInput' class="form-control" type="date" name="scheduled_date" min="{{ now()->format('Y-m-d') }}" required>
            <x-form-feedback error="scheduled_date" />
        </div>

        <div class="form-check">
            <input class="form-check-input" id="keepOldWorkersCheckbox" type="checkbox" name="keep_old_workers" value="1" checked>
            <label class="form-check-label" for="keepOldWorkersCheckbox">Keep workers already saved in work orders.</label>
        </div>
    </form>
    <br>
    
    <div class="alert alert-warning small">
        <em>Only workers on work orders that have an incomplete process status and active crews will be modified.</em>
    </div>

    @slot('footer')
    <x-modal-button-close>Cancel</x-modal-button-close>
    <button class="btn btn-warning" type="submit" form="formSetCrewMembersOnWorkOrders">Update work orders</button>
    @endslot

</x-modal>
