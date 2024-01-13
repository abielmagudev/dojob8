<x-card title="Work orders" subtitle="Last 10">
    @if( $contractor->work_orders->count() )

    <x-slot name="options">
        @if( $contractor->hasUnfinishedWorkOrders() )                  
        @include('work-orders.__.button-unfinished', [
            'class' => 'btn btn-warning',
            'counter' => $contractor->work_orders_unfinished_count,
            'parameters' => ['contractor' => $contractor->id],
        ])
        @endif

        @include('work-orders.__.button-all', [
            'class' => 'btn btn-primary',
            'counter' => $contractor->work_orders->count(),
            'parameters' => ['contractor' => $contractor->id],
        ])
    </x-slot>

    <x-table class="align-middle">
        <x-slot name="thead">
            <tr>
                <th>Scheduled</th>
                <th>Job</th>
                <th>Client</th>
                <th>Crew</th>
                <th>Status</th>
                <th></th>
            </tr>
        </x-slot>

        @foreach($contractor->work_orders->take(10) as $work_order)
        <tr>
            <td class="text-nowrap">{{ $work_order->scheduled_date_human }}</td>
            <td class="text-nowrap">{{ $work_order->job->name }}</td>
            <td class="text-nowrap">
                @include('clients.__.address-table-cell', ['client' => $work_order->client])
            </td>
            <td>
                @include('crews.__.flag', [
                    'name' => $work_order->crew->name,
                    'background_color' => $work_order->crew->background_color,
                    'text_color' => $work_order->crew->text_color,
                    'class' => 'd-block',
                ])
            </td>
            <td>{{ $work_order->status }}</td>
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
