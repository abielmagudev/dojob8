<p>
    <b>{{ $extension->name }}</b>
</p>
<x-table>
    @slot('thead')
    <tr>
        <th>Item Price ID</th>
        <th>Product</th>
        <th>Quantity</th>
    </tr>
    @endslot

    @foreach($work_order_products as $service)
    <tr>
        <td>{{ $service->product->item_price_id }}</td>
        <td>{{ $service->product->name }}</td>
        <td>{{ $service->quantity }}</td>
    </tr>
    @endforeach
</x-table>
<br>
