<table>
    <thead>
        <tr>
            <th>Order</th>
            <th>Item ID</th>
            <th>Product</th>
            <th>Material price</th>
            <th>Labor price</th>
            <th>Unit price</th>
            <th>Quantity</th>
            <th>Cost</th>
        </tr>
    </thead>
    <tbody>
        <?php $total = 0; ?>
        @foreach($measures as $measure)            
        <tr>
            <td>{{ $measure->order->id }}</td>
            <td>{{ $measure->product->item_price_id }}</td>
            <td>{{ $measure->product->name }}</td>
            <td>${{ $measure->product->material_price }}</td>
            <td>${{ $measure->product->labor_price }}</td>
            <td>${{ $measure->product->unit_price }}</td>
            <td>{{ $measure->quantity }}</td>
            <td>${{ ($measure->product->unit_price * $measure->quantity) }}</td>
        </tr>
        <?php $total += $measure->product->unit_price * $measure->quantity; ?>
        @endforeach
        <tr></tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td>Records</td>
            <td>Product</td>
            <td>From</td>
            <td>To</td>
            <td>Total</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td style="font-weight: bold; text-align:left">{{ $measures->count() }}</td>
            <td style="font-weight: bold">{{ $product_name }}</td>
            <td style="font-weight: bold">{{ $from_at }}</td>
            <td style="font-weight: bold">{{ $to_at }}</td>
            <td style="font-weight: bold">${{ $total }}</td>
        </tr>
    </tbody>
</table>
