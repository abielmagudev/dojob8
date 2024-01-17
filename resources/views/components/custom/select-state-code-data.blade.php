<?php 
$country_selected = $countries->get( $attributes->get('country') ) ?? $countries->get( $country_code_default );

$state_code_to_select = $country_selected->get('states')->get( $attributes->get('old') ) 
                        ? $attributes->get('old') 
                        : $state_code_default;
?>
<select id="stateCodeSelect" class="form-select {{ bsInputInvalid( $errors->has('state_code') ) }} {{ $attributes->get('class', '') }}" name="state_code" @if( $attributes->has('required') ) required @endif>
    @if(! $attributes->has('required') )
    <option selected label="Any state of country"></option>
    @endif
    
    @foreach($country_selected->get('states') as $code => $state)
    <option value="{{ $code }}" {{ isSelected( ($state_code_to_select == $code) ) }}>{{ $state }} ({{ $code }})</option>
    @endforeach
</select>
