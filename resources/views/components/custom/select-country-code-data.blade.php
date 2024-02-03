<?php

// $countries = $countryManager->all();

// $countries = $countryManager->only( $configuration->get('country_code', 'US') );

$countries = $countryManager->only('US');

$selected = $slot->isNotEmpty() ? $slot : $configuration->get('country_code');

?>
<select 
    id="countryCodeSelect" 
    class="form-select {{ bsInputInvalid( $errors->has('country_code') ) }} {{ $attributes->get('class', '') }}" 
    name="country_code" 
    
    @if( $attributes->has('required') )
    required
    @endif
>
    @if(! $attributes->has('required') &&! $attributes->has('any') )
    <option selected></option>
    @endif

    @if( $attributes->has('any') )
    <option selected>Any country</option>
    @endif

    @foreach($countries as $code => $country)
    <option value="{{ $code }}" {{ isSelected( ($selected == $code) ) }}>{{ $country->get('name') }}</option>
    @endforeach
</select>
