<x-card title="Work orders" class="h-100">
    <x-slot name="options">
        @includeWhen($client->hasIncompleteWorkOrders(), 'work-orders.__.button-counter-incomplete', [
            'counter' => $client->incomplete_work_orders_counter,
            'parameters' => ['client' => $client->id],
            'class' => 'btn btn-outline-warning',
        ])

        @includeWhen($client->hasWorkOrders(), 'work-orders.__.button-counter-all', [
            'counter' => $client->work_orders_counter,
            'parameters' => ['client' => $client->id],
            'class' => 'btn btn-outline-primary',
        ])

        <a href="{{ route('work-orders.create', ['client' => $client->id]) }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i>
        </a>
    </x-slot>

    @if( $client->hasWorkOrders() )          
    <x-table class="align-middle ">
        @slot('thead')
        <tr>
            <th></th>
            <th>Scheduled</th>
            <th>Job</th>
            <th class="text-center">Crew</th>
            <th class="text-center">Contractor</th>
            <th class="text-center">Status</th>
            <th></th>
        </tr>
        @endslot

        @foreach($client->work_orders->sortByDesc('id') as $work_order)
        <tr>
            <td class="text-center text-secondary">{{ $work_order->id }}</td>

            <td class="text-nowrap">{{ $work_order->scheduled_date_human }}</td>

            <td class="text-nowrap">
                @include('work-orders.__.summary-job')
            </td>

            <td>
                @includeWhen($work_order->hasCrew(), 'crews.__.flag', [
                    'crew' => $work_order->crew,
                    'class' => 'w-100',
                ])
            </td>

            <td>
                @if( $work_order->hasContractor() )              
                @include('contractors.__.flag', [
                    'name' => $work_order->contractor->alias,
                    'tooltip' => $work_order->contractor->name,
                    'class' => 'w-100',
                ])
                @endif
            </td>

            <td>
                @include('work-orders.__.flag-status', [
                    'status' => $work_order->status,
                    'class' => 'd-block',
                ])
            </td>

            <td class="text-end w-1">
                <a href="{{ route('work-orders.show', $work_order) }}" class="btn btn-outline-primary btn-sm">
                    <i class="bi bi-eye-fill"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </x-table>
    @endif
</x-card>
