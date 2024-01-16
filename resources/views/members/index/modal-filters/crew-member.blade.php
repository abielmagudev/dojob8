<div class="mb-3">
    <label for="isCrewMemberSelect" class="form-label">Crew member</label>
    <select id="isCrewMemberSelect" name="is_crew_member" class="form-select">
        <option label="Any option"></option>
        <option value="1" {{ isSelected( $request->get('is_crew_member') === "1" ) }}>Yes, can be in crews</option>
        <option value="0" {{ isSelected( $request->get('is_crew_member') === "0" ) }}>No, cannot be in crews</option>
    </select>
</div>
