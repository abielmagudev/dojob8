<x-card title="Work orders" class="h-100">
    <x-slot name="options">
        <a href="{{ route('work-orders.create', $client) }}" class="btn btn-primary">
            <b>+</b>
        </a>
    </x-slot>

    @if( $client->work_orders->count() )          
    <x-table class="align-middle ">
        @foreach($client->work_orders as $work_order)
        <tr>
            <td>{{ $work_order->job->name }}</td>
            <td>{{ $work_order->scheduled_datetime_human }}</td>
            <td class="text-end">
                <a href="{{ route('work-orders.show', $work_order) }}" class="btn btn-outline-primary">
                    <i class="bi bi-eye-fill"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </x-table>
    @endif
</x-card>
