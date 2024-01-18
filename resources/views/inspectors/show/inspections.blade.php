<x-card title="Inspections">
    @slot('options')
        @if( $inspector->hasPendingInspections() )
        @include('inspections.__.button-counter-pending', [
            'counter' => $inspector->pending_inspections->count(),
            'parameters' => ['inspector' => $inspector->id],
            'class' => 'btn btn-warning'
        ])
        @endif

        @if( $inspector->hasOnHoldInspections() )
        @include('inspections.__.button-counter-on-hold', [
            'counter' => $inspector->on_hold_inspections->count(),
            'parameters' => ['inspector' => $inspector->id],
            'class' => 'btn btn-primary'
        ])
        @endif

        @include('inspections.__.button-counter-all', [
            'class' => 'btn btn-primary',
            'counter' => $inspector->inspections->count(),
            'parameters' => ['inspector' => $inspector->id],          
        ])
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
                @include('inspections.__.status-flag', [
                    'status' => $inspection->status,
                    'class' => 'w-100',
                ])
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
                @include('clients.__.inline-summary-information', ['client' => $inspection->work_order->client])
            </td>
            <td>
                <a href="{{ route('work-orders.show', $inspection->work_order_id) }}">#{{ $inspection->work_order_id }}</a>
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