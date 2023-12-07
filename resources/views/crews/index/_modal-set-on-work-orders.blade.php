<x-modal id="modalSetOnWorkOrders" title="Update work orders" header-close footer-close>
    <form action="#!" method="post" autocomplete="off" id="formSetOnWorkOrders">
        @method('put')
        @csrf
        <div class="mb-3">
            <label for="scheduledDateInput" class="form-label">Schedule date</label>
            <input id='scheduledDateInput' class="form-control" type="date" name="scheduled_date" value="">
        </div>

        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="keep_crew_memberd" value="1" id="keepCrewMembersCheckbox" checked>
            <label class="form-check-label" for="keepCrewMembersCheckbox">Maintain crew members established on work orders.</label>
        </div>
    </form>

    @slot('footer')
    <button class="btn btn-warning" type="submit">Set crew members on work orders</button>
    @endslot
</x-modal>
