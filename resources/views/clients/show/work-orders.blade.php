<x-card title="Work orders" class="h-100">
    <x-slot name="options">
        @includeWhen($client->hasUnfinishedWorkOrders(), 'work-orders.__.button-counter-unfinished', [
            'counter' => $client->work_orders_unfinished_count,
            'parameters' => ['client' => $client->id],
            'class' => 'btn btn-warning',
        ])

        @include('work-orders.__.button-counter-all', [
            'counter' => $work_orders->count(),
            'parameters' => ['client' => $client->id],
            'class' => 'btn btn-primary',
        ])

        <a href="{{ route('work-orders.create', $client) }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i>
        </a>
    </x-slot>

    @if( $work_orders->count() )          
    <x-table class="align-middle ">
        @slot('thead')
        <tr>
            <th>Scheduled</th>
            <th>Job</th>
            <th>Contractor</th>
            <th>Crew</th>
            <th>Status</th>
            <th></th>
        </tr>
        @endslot

        @foreach($work_orders as $work_order)
        <tr>
            <td>{{ $work_order->scheduled_date_human }}</td>
            <td>{{ $work_order->job->name }}</td>
            <td>{{ $work_order->hasContractor() ? $work_order->contractor->name : '' }}</td>
            <td>{{ $work_order->crew->name }}</td>
            <td>
                <span class="badge border text-uppercase">{{ $work_order->status }}</span>
            </td>
            <td class="text-end">
                <a href="{{ route('work-orders.show', $work_order) }}" class="btn btn-outline-primary btn-sm">
                    <i class="bi bi-eye-fill"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </x-table>
    @endif
</x-card>
