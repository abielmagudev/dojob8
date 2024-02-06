<div class="alert alert-warning">
    <div class="form-check form-switch">
        <input id="availableStatusSwitch" class="form-check-input" type="checkbox" role="switch" name="available" value="1" {{ isChecked( $toggle ) }}>
        <label for="availableStatusSwitch" class="form-check-label">{!! $slot !!}</label>
    </div>
</div>
