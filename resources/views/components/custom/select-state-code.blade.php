<?php 

$country_selected = $countries->get( $attributes->get('country') ) ?? $countries->get( $country_code_default );
$state_code_to_select = $country_selected->get('states')->get( $attributes->get('old') ) ? $attributes->get('old') : $state_code_default;

?>

<select id="stateCodeSelect" class="form-select {{ bsInputInvalid( $errors->has('state_code') ) }}" name="state_code">
    @foreach($country_selected->get('states') as $code => $state)
    
    
    <option value="{{ $code }}" {{ isSelected( ($state_code_to_select == $code) ) }}>{{ $state }}</option>
    
    @endforeach
</select>
