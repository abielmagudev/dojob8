<div class="alert alert-warning">
    <div class="form-check form-switch">
        <input id="activeStatusSwitch" class="form-check-input" type="checkbox" role="switch" name="active" value="1" {{ isChecked( $toggle ) }}>
        <label for="activeStatusSwitch" class="form-check-label">{!! $slot !!}</label>
    </div>
</div>
