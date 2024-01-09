<input 
    id="cityNameInput" 
    type="text" 
    class="form-control {{ $attributes->get('class', '') }} {{ bsInputInvalid($errors->has('city')) }}" 
    name="city_name" 
    value="{{ $attributes->get('old', $city_name_default) }}" 
    @if( $attributes->has('required') ) required @endif>
