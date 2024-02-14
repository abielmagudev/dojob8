<input 
    type="text" 

    id="cityNameInput" 
    
    name="city_name" 
    
    value="{{ $slot->isEmpty() && $attributes->has('required') ? $settings->get('city_name') : $slot }}" 
    
    class="form-control {{ bsInputInvalid($errors->has('city_name')) }} {{ $attributes->get('class', '') }}" 

    @if( $attributes->has('required') )
    required
    @endif
>
