<x-modal id="modalClientNewWorkOrder" title="New work order" header-close>  
    <x-clients.floating-suggestions url="{{ route('work-orders.create', ['client' => '{id}']) }}" />
    <br>
    <p class="text-center" style="text-wrap:balance">
        <span class="text-secondary">If it was not found, then create</span> 
        <a href="{{ route('clients.create') }}">new client</a>
    </p>
</x-modal>

@push('scripts')
<script>
const modalClientNewWorkOrder = {
    element: document.getElementById('modalClientNewWorkOrder'),
    listen: function () {
        this.element.addEventListener('shown.bs.modal', function () {
            floatingClientSuggestions.elements().inputSelector.focus();
        })

        this.element.addEventListener('hidden.bs.modal', function () {
            floatingClientSuggestions.reset();
        })
    }
}
modalClientNewWorkOrder.listen()
</script>
@endpush
