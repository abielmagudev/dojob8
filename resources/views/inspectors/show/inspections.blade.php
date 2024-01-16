<x-card title="Inspections">
    @slot('options')
        @if( $inspector->hasPendingOrOnHoldInspections() )
        <x-tooltip title="Pending & on hold inspections">
            <a href="{{ inspectionUrlGenerator('pendingOrOnHold', ['inspector' => $inspector->id]) }}" class="btn btn-warning">
                {{ $inspector->pending_and_on_hold_inspections->count() }}
            </a>
        </x-tooltip>
        @endif

        <x-tooltip title="All inspections">
            <a href="{{ inspectionUrlGenerator('all', ['inspector' => $inspector->id]) }}" class="btn btn-primary">
                {{ $inspector->inspections->count() }}
            </a>
        </x-tooltip>
    @endslot

    @if( $inspector->hasInspections() )
    <p class="text-secondary">
        <i class="bi bi-info-circle"></i>
        <em>Last 10 inspections</em>
    </p>

    <x-table>
        @slot('thead')
        <tr>
            <th>Status</th>
            <th>Scheduled</th>
            <th>Job</th>
            <th>Crew</th>
            <th>Client</th>
            <th class="text-nowrap">Work order</th>
            <th></th>
        </tr>
        @endslot

        @foreach($inspector->inspections->take(10) as $inspection)
        <tr>
            <td style="width:1%">
                @include('inspections.__.status_color', ['status' => $inspection->status])
            </td>
            <td class="text-nowrap">{{ $inspection->scheduled_date_human }}</td>
            <td class="text-nowrap">{{ $inspection->work_order->job->name }}</td>
            <td>
                @if( $inspection->hasCrew() )
                    @include('crews.__.flag', [
                        'crew' => $inspection->crew,
                        'class' => 'w-100',
                    ])
                @endif
            </td>
            <td class="text-nowrap">
                @include('clients.__.address-table-cell', ['client' => $inspection->work_order->client])
            </td>
            <td>
                <a href="{{ route('work-orders.show', $inspection->work_order_id) }}">{{ $inspection->work_order_id }}</a>
            </td>
            <td class="text-end">
                <a href="{{ route('inspections.show', $inspection) }}" class="btn btn-outline-primary btn-sm">
                    <i class="bi bi-eye-fill"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </x-table>
    @endif
</x-card>