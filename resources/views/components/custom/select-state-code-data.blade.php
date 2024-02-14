<?php 

$country_loaded = $countryManager->exists( $attributes->get('country') ) 
                ? $countryManager->get( $attributes->get('country') ) 
                : $countryManager->get( $settings->get('country_code', 'US') );

$selected = $slot->isNotEmpty() ? $slot : $settings->get('state_code');

?>
<select 
    id="stateCodeSelect" 
    class="form-select {{ bsInputInvalid( $errors->has('state_code') ) }} {{ $attributes->get('class', '') }}" 
    name="state_code" 

    @if( $attributes->has('required') )
    required
    @endif
>
    @if(! $attributes->has('required') &&! $attributes->has('any') )
    <option selected></option>
    @endif
    
    @if( $attributes->has('any') )
    <option selected>Any state</option>
    @endif

    @foreach($country_loaded->get('states') as $code => $state)
    <option value="{{ $code }}" {{ isSelected( ($selected == $code) ) }}>{{ $state }}</option>
    @endforeach
</select>
