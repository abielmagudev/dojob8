<x-modal id="modalCreateOrderClient" title="Search client">
    <form action="{{ route('orders.create') }}" method="get">
        <div class="mb-3">
            <input type="text" class="form-control" name="client">
        </div>
        <div class="text-end">
            <button class="btn btn-success">Create new order</button>
        </div>
    </form>
</x-modal>
