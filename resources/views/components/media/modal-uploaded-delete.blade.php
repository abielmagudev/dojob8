<!-- Trigger -->
<x-modal-trigger modal-id="mediaDeleteModal" class="btn btn-outline-danger">
    @if( $slot->isEmpty() )
    <i class="bi bi-trash3"></i>
    
    @else
    {!! $slot !!}

    @endif
</x-modal-trigger>

<!-- Modal -->
@push('end')   
<x-modal id="mediaDeleteModal" footer-class="justify-content-center" header-close>
    <h2 class="text-center text-danger">WARNING!</h2>
    <p class="text-center fs-5 my-4" style="text-wrap:balance">Do you want to <span class="text-danger">permanently</span> delete the selected files?</p>
    <form action="{{ $action }}" method="post" id="mediaDeleteForm">
        @method('delete')
        @csrf
    </form>
    <x-slot name="footer">
        <x-modal-button-close>Cancel</x-modal-button-close>
        <button class="btn btn-outline-danger" type="submit" form="mediaDeleteForm">Yes, delete selected files</button>
    </x-slot>
</x-modal>
@endpush
