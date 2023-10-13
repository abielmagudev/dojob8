<div class="text-end">
    <x-modal-trigger modal-id="modalConfirmDelete" class="btn btn-outline-danger border-0">
        <span>Delete {{ $attributes->get('name') }}</span>
    </x-modal-trigger>
</div>

<x-modal id="modalConfirmDelete" title="ATENTION" footer-class="justify-content-center" header-close footer-close>
    
    <form action="{{ $attributes->get('route') }}" method="post" id='formConfirmDelete'>
        @csrf
        @method('delete')
        <div class="text-center">
            {!! $slot !!}
        </div>
    </form>

    <x-slot name="footer">
        <button class="btn btn-outline-danger" type="submit" form="formConfirmDelete">Yes, delete {{ $attributes->get('name') }}</button>
    </x-slot>
</x-modal>
