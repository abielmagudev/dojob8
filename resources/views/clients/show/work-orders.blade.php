<x-card title="Work orders" class="h-100">
    <x-slot name="options">
        @includeWhen($client->hasUnfinishedWorkOrders(), 'work-orders.__.button-counter-unfinished', [
            'counter' => $client->work_orders_unfinished_count,
            'parameters' => ['client' => $client->id],
            'class' => 'btn btn-warning',
        ])

        @include('work-orders.__.button-counter-all', [
            'counter' => $client->work_orders->count(),
            'parameters' => ['client' => $client->id],
            'class' => 'btn btn-primary',
        ])

        <a href="{{ route('work-orders.create', $client) }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i>
        </a>
    </x-slot>

    @if( $client->work_orders->count() )          
    <x-table class="align-middle ">
        @slot('thead')
        <tr>
            <th>Scheduled</th>
            <th>Crew</th>
            <th>Job</th>
            <th>Contractor</th>
            <th>Status</th>
            <th></th>
        </tr>
        @endslot

        @foreach($client->work_orders->sortByDesc('id') as $work_order)
        <tr>
            <td class="text-nowrap" style="width:1%">{{ $work_order->scheduled_date_human }}</td>
            <td>
                @include('crews.__.flag', [
                    'crew' => $work_order->crew,
                    'class' => 'w-100'
                ])
            </td>
            <td class="text-nowrap">{{ $work_order->job->name }}</td>
            <td class="text-nowrap">
                @if( $work_order->hasContractor() )              
                @include('contractors.__.flag', [
                    'name' => $work_order->contractor->alias,
                    'tooltip' => $work_order->contractor->name,
                    'class' => 'd-block',
                ])
                @endif
            </td>
            <td>
                @include('work-orders.__.status-flag', [
                    'status' => $work_order->status,
                    'class' => 'd-block',
                ])
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
