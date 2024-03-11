<x-modal id="crewMemberAssignmentModal" title="Crew members" header-close>

    <div class="alert alert-info text-center small" style="text-wrap:balance">
        <em>Only crew members whose assignments have incomplete processes and active crews will be updated.</em>
    </div>

    <form action="{{ route('crew-members.assignment.update') }}" method="post" autocomplete="off" id="crewMemberAssignmentForm">
        @method('patch')
        @csrf
        <input type="hidden" name="template" value="{{ $template }}">

        <div class="mb-3">
            <label for="scheduledDateInput" class="form-label">Schedule</label>
            <input id='scheduledDateInput' class="form-control" type="date" name="scheduled_date" min="{{ now()->format('Y-m-d') }}" required>
            <x-form-feedback error="scheduled_date" />
        </div>

        <div class="mb-3">
            <label for="assignmentSelect" class="form-label">Assignment</label>
            <select name="assignment" id="assignmentSelect" class="form-select">
                <option value="work orders">Work orders</option>
                <option value="inspections">Inspections</option>
            </select>
            <x-form-feedback error="assigment" />
        </div>

        <div class="form-check">
            <input class="form-check-input" id="keepCrewMembersSaved" type="checkbox" name="keep_crew_members_saved" value="1" checked>
            <label class="form-check-label" for="keepCrewMembersSaved">Keep crew members already saved.</label>
        </div>
    </form>

    @slot('footer')
    <x-modal-button-close>Cancel</x-modal-button-close>
    <button class="btn btn-warning" type="submit" form="crewMemberAssignmentForm">Send crew members</button>
    @endslot
</x-modal>
