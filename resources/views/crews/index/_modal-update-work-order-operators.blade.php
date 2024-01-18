<x-modal id="modalUpdateWorkOrderWorkers" title="Work orders by scheduled date" header-close footer-close>
    <form action="{{ route('work-orders.update.workers', ['show' => $show]) }}" method="post" autocomplete="off" id="formSetCrewMembersOnWorkOrders">
        @method('patch')
        @csrf
        <div class="mb-3">
            <label for="scheduledDateInput" class="form-label">Schedule date</label>
            <input id='scheduledDateInput' class="form-control" type="date" name="scheduled_date" value="" required>
            <x-form-feedback error="scheduled_date" />
        </div>

        <div class="form-check">
            <input class="form-check-input" id="keepOldWorkersCheckbox" type="checkbox" name="keep_old_workers" value="1" checked>
            <label class="form-check-label" for="keepOldWorkersCheckbox">Keep workers already saved in work orders.</label>
        </div>
    </form>

    <hr>
    
    <p>Explicar su funcionamiento</p>
    <ul>
        <li>Solo trabajos no cerrados</li>
        <li>Crews activos</li>
        <li>Crews con members</li>
    </ul>

    @slot('footer')
    <button class="btn btn-warning" type="submit" form="formSetCrewMembersOnWorkOrders">Update workers on work orders</button>
    @endslot
</x-modal>
