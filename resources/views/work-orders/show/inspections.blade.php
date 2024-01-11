<x-card>
    <div class="mb-3">
        <div class="badge text-bg-dark">Required {{ $work_order->job->inspections_required_count }}</div>
        <div class="badge text-bg-success">Approved {{ $inspections->where('is_approved', 1)->count() }}</div>
        <div class="badge text-bg-primary">Total {{ $inspections->count() }}</div>
    </div>

    @if( $inspections->count() )
    <x-table>
        <x-slot name="thead">
            <tr>
                <th>Schedule</th>
                <th>Inspector</th>
                <th>Crew</th>
                <th>Observations</th>
                <th>Status</th>
                <th></th>
            </tr>
        </x-slot>

        @foreach($inspections->sortByDesc('scheduled_date') as $inspection)
        <tr @class(['align-middle' => strlen($inspection->observations) < 100])>
            <td class="text-nowrap pe-5" style="width:1%">
                {{ $inspection->scheduled_date_human }}
            </td>
            <td class="text-nowrap">
                {{ $inspection->inspector->name }}
            </td>
            <td class="text-nowrap">
                @if( $inspection->hasCrew() )
                {{ $inspection->crew->name }}
                @endif
            </td>
            <td style="min-width:240px; max-width:480px">
                {{ $inspection->observations }}
            </td>
            <td>
                <span class="{{ $inspection->status_color }} text-uppercase">{{ $inspection->status }}</span>
            </td>
            <td class="text-nowrap text-end">
                <a href="{{ route('inspections.edit', [$inspection, 'tab' => 'inspections']) }}" class="btn btn-outline-warning">
                    <i class="bi bi-pencil-fill"></i>
                </a>
            </td>
        </tr>
        @endforeach

    </x-table>
    @endif

    @slot('footer')
    <div class="py-1 text-end">    
        <a href="{{ route('inspections.create', $work_order) }}" class="btn btn-primary">
            <span>Add new inspection</span>
        </a>
    </div>
    @endslot
</x-card>
