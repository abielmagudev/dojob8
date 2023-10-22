<x-modal id="modalCreateOrderClient" title="Search client">
    <form action="{{ route('orders.create') }}" method="get">
        <div class="mb-1">
            <label for="inputSearchClient" class="form-label">Client</label>
            <input id="inputSearchClient" type="search" class="form-control" name="client" placeholder="Search like by name, address, email..." required>
        </div>
    </form>
    <p class="text-end text-secondary">
        <span class="text-secondary">...or</span>
        <a href="{{ route('clients.create') }}">create a new client</a>
    </p>
</x-modal>
