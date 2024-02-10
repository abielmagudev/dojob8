<x-card title="Work orders" subtitle="Last 10" class="mb-3">
    @slot('options')
        @if( $contractor->hasWorkOrdersWithIncompleteStatus() )                  
        @include('work-orders.__.button-counter-incomplete', [
            'class' => 'btn btn-warning',
            'counter' => $contractor->onlyIncompleteWorkOrders()->count(),
            'parameters' => ['contractor' => $contractor->id],
        ])
        @endif

        @include('work-orders.__.button-counter-all', [
            'class' => 'btn btn-primary',
            'counter' => $contractor->work_orders->count(),
            'parameters' => ['contractor' => $contractor->id],
        ])
    @endslot

    @if( $contractor->hasWorkOrders() )
    <x-table>
        <x-slot name="thead">
            <tr>
                <th>Scheduled</th>
                <th>Crew</th>
                <th>Job</th>
                <th>Client</th>
                <th>Status</th>
                <th></th>
            </tr>
        </x-slot>

        @foreach($contractor->work_orders->sortByDesc('id')->take(10) as $work_order)
        <tr>
            <td class="text-nowrap" style="width:1%">{{ $work_order->scheduled_date_human }}</td>
            <td>
                @include('crews.__.flag', [
                    'crew' => $work_order->crew,
                    'class' => 'w-100',
                ])
            </td>
            <td class="text-nowrap">{{ $work_order->job->name }}</td>
            <td class="text-nowrap">
                @include('clients.__.accordion-address-contact', ['client' => $work_order->client])
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
