<?php
$country_code_to_select = $countries->get( $attributes->get('old') ) 
                        ? $attributes->get('old') 
                        : $country_code_default;
?>
<select id="countryCodeSelect" class="form-select {{ bsInputInvalid( $errors->has('country_code') ) }} {{ $attributes->get('class', '') }}" name="country_code" @if( $attributes->has('required') ) required @endif>
    @if(! $attributes->has('required') )
    <option selected label="Any country"></option>
    @endif

    @foreach($countries as $code => $country)
    <option value="{{ $code }}" {{ isSelected( ($country_code_to_select == $code) ) }}>{{ $country->get('name') }}</option>
    @endforeach
</select>
