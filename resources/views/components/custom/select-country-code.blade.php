<?php

$country_code_to_select = $countries->search( $attributes->get('old') ) <> false ? $attributes->get('old') : $country_code_default;

?>
<select id="countryCodeSelect" class="form-select {{ bsInputInvalid( $errors->has('country_code') ) }}" name="country_code">
    @foreach($countries as $code => $country)

    <option value="{{ $code }}" {{ isSelected( ($country_code_to_select == $code) ) }}>{{ $country->get('name') }}</option>
    
    @endforeach
</select>
