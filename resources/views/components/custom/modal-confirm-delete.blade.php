<div class="text-end">
    <x-modal-trigger modal-id="modalConfirmDelete" class="btn btn-outline-danger border-0">
        <span>Delete {{ $attributes->get('concept') }}</span>
    </x-modal-trigger>
</div>

<x-modal id="modalConfirmDelete" dialog-class="modal-dialog-centered">
    <div class="text-center">
        <p class="h2 text-danger mb-4">Attention</p>
        <div class="mb-5">{!! $slot !!}</div>

        <form action="{{ $attributes->get('route') }}" method="post" id='formConfirmDelete'>
            @csrf
            @method('delete')
            <button class="btn btn-dark" type="button" data-bs-dismiss="modal">Cancel</button>
            <button class="btn btn-outline-danger" type="submit" form="formConfirmDelete">Yes, delete {{ $attributes->get('concept') }}</button>
        </form>
    </div>
</x-modal>
