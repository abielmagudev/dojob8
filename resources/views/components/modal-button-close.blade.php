<button 
    type="button" 
    class="{{ $attributes->get('class', 'btn btn-dark') }}" 
    data-bs-dismiss="modal"
>
    {!! $slot !!}
</button>
