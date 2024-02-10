<x-card title="{{ $job->work_orders->count() }} work orders">
    @if( $job->work_orders->count() )      
    <p class="text-secondary">
        <em>Last 10 work orders</em>
    </p>

    <x-table>
        @slot('thead')
        <tr>
            <th>Scheduled</th>
            <th>Crew</th>
            <th>Contractor</th>
            <th>Client</th>
            <th>Status</th>
            <th></th>
        </tr>
        @endslot
        @foreach($job->work_orders->load(['contractor','crew','client'])->take(10) as $work_order)
        <tr>
            <td>{{ $work_order->scheduled_date_human }}</td>
            <td>
                @include('crews.__.flag', ['crew' => $work_order->crew])
            </td>
            <td>
            @if( $work_order->hasContractor() )
                @include('contractors.__.flag', ['name' => $work_order->contractor->alias, 'tooltip' => $work_order->contractor->name])
            @endif
            </td>
            <td>
                @include('clients.__.accordion-address-contact', ['client' => $work_order->client])
            </td>
            <td>
                @include('work-orders.__.status-flag', ['status' => $work_order->status])
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
