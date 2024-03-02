<x-card>
    @slot('title')
    <div>
        <span class="me-2">{{ $inspections->count() }}</span>
        @if($work_order->job->requiresSuccessInspections())
        <div class="badge border border-success text-success">{{ $work_order->job->success_inspections_required_count }} Approved required</div>
        @endif
    </div>
    @endslot

    @slot('options')
    <a href="{{ route('inspections.create', ['work_order' => $work_order->id]) }}" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i>
    </a>
    @endslot


    @if( $inspections->count() )
    <x-table>
        <x-slot name="thead">
            <tr>
                <th>Schedule</th>
                <th>Status</th>
                <th>Agency</th>
                <th>Inspector</th>
                <th>Crew</th>
                <th>Observations</th>
                <th></th>
            </tr>
        </x-slot>

        @foreach($inspections->sortByDesc('scheduled_date') as $inspection)
        <tr @class(['align-middle' => strlen($inspection->observations) < 100])>
            <td class="text-nowrap" style="width:1%">
                {{ $inspection->scheduled_date_human }}
            </td>
            <td style="width:1%">
                @includeWhen($inspection->hasNoPendingAttributes(), 'inspections.__.flag-status', ['status' => $inspection->status])
                @includeWhen($inspection->hasPendingAttributes(), 'components.custom.flag-pending')
            </td>
            <td class="text-nowrap">
                {{ $inspection->agency->name }}
            </td>
            <td class="text-nowrap">
                {{ $inspection->inspector_name }}
            </td>
            <td class="text-nowrap">
                @if( $inspection->hasCrew() )
                {{ $inspection->crew->name }}
                @endif
            </td>
            <td style="min-width:240px; max-width:480px">
                {{ $inspection->observations }}
            </td>
            <td class="text-nowrap text-end" style="width:1%">
                <a href="{{ route('inspections.edit', $inspection) }}" class="btn btn-outline-warning btn-sm">
                    <i class="bi bi-pencil-fill"></i>
                </a>
            </td>
        </tr>
        @endforeach

    </x-table>
    @endif
</x-card>
