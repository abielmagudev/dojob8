<x-modal id="modalUpdateWorkOrderOperators" title="Work orders by scheduled date" header-close footer-close>
    <form action="{{ route('work-orders.update.operators', ['show' => $show]) }}" method="post" autocomplete="off" id="formSetCrewMembersOnWorkOrders">
        @method('patch')
        @csrf
        <div class="mb-3">
            <label for="scheduledDateInput" class="form-label">Schedule date</label>
            <input id='scheduledDateInput' class="form-control" type="date" name="scheduled_date" value="" required>
            <x-error name="scheduled_date" />
        </div>

        <div class="form-check">
            <input class="form-check-input" id="keepOldOperatorsCheckbox" type="checkbox" name="keep_old_operators" value="1" checked>
            <label class="form-check-label" for="keepOldOperatorsCheckbox">Keep operators already saved in work orders.</label>
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
    <button class="btn btn-warning" type="submit" form="formSetCrewMembersOnWorkOrders">Update operators on work orders</button>
    @endslot
</x-modal>
