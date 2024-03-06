<x-modal id="mediaDeleteModal" footer-class="justify-content-center" header-close>
    <h2 class="text-center text-danger">WARNING!</h2>
    <p class="text-center fs-5 my-4" style="text-wrap:balance">Do you want to <span class="text-danger">permanently delete</span> the selected files?</p>
    <form action="{{ route('media.destroy') }}" method="post" id="mediaDeleteForm">
        @method('delete')
        @csrf
        <input type="hidden" name="model_key" value="work-order">
        <input type="hidden" name="model_id" value="{{ $work_order->id }}">
    </form>
    <x-slot name="footer">
        <x-modal-button-close>Cancel</x-modal-button-close>
        <button class="btn btn-outline-danger" type="submit" form="mediaDeleteForm">Delete photos and files</button>
    </x-slot>
</x-modal>
