<button 
    type="button" 
    class="{{ $attributes->get('btn btn-dark', '') }}" 
    data-bs-dismiss="modal"
>
    {!! $slot !!}
</button>
