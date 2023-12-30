<x-card>

    <x-slot name="options">
        <a href="{{ route('inspections.create', $work_order) }}" class="btn btn-primary">
            <b>+</b>
        </a>
    </x-slot>

    <div class="mb-3">
        <div class="badge text-bg-dark">Required {{ $work_order->job->approved_inspections_required }}</div>
        <div class="badge text-bg-success">Approved {{ $work_order->inspections->where('is_approved', 1)->count() }}</div>
        <div class="badge text-bg-primary">Total {{ $work_order->inspections->count() }}</div>
    </div>

    @if( $work_order->inspections->count() )
    <x-table>
        <x-slot name="thead">
            <tr>
                <th>Schedule</th>
                <th>Inspector</th>
                <th>Observations</th>
                <th>Notes</th>
                <th>Status</th>
                <th></th>
            </tr>
        </x-slot>

        @foreach($work_order->inspections->sortByDesc('scheduled_date')->load('inspector') as $inspection)
        <tr @class(['align-middle' => strlen($inspection->observations) < 100])>
            <td class="text-nowrap pe-5" style="width:1%">{{ $inspection->scheduled_date_human }}</td>
            <td class="text-nowrap">{{ $inspection->inspector ? $inspection->inspector->name : '' }}</td>
            <td style="min-width:240px; max-width:480px">{{ $inspection->observations }}</td>
            <td style="min-width:240px; max-width:480px">{{ $inspection->notes }}</td>
            <td>
                <x-badge :color="$inspection->status_color" class="text-uppercase">{{ $inspection->status }}</x-badge>
            </td>
            <td class="text-nowrap text-end">
                <a href="{{ route('inspections.edit', $inspection) }}" class="btn btn-outline-warning">
                    <i class="bi bi-pencil-fill"></i>
                </a>
            </td>
        </tr>
        @endforeach

    </x-table>
    @endif
</x-card>
