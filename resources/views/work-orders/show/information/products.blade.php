<h6 class="text-secondary">Products</h6>
<div class="alert border rounded mb-3">
    <x-table>
        <x-slot name="thead">
            <tr>
                <th>Name</th>
                <th>Quantity</th>
                <th>Indications</th>
            </tr>
        </x-slot>

        @foreach($work_order->products as $product)
        <tr>
            <td>{{ $product->name }}</td>
            <td>{{ $product->pivot->quantity }} {{ $product->measurement_unit }}</td>
            <td>{{ $product->pivot->indications }}</td>
        </tr>
        @endforeach
    </x-table>
</div>
