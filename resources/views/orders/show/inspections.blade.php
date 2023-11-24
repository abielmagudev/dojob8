<x-card title="Inspections">
    <x-slot name="options">
        <a href="{{ route('inspections.create', $order) }}" class="btn btn-primary">
            <b>+</b>
        </a>
    </x-slot>

    <div class="alert alert-light text-black mb-3">
        <div class="d-flex justify-content-center text-center text-uppercase">
            <div>
                <small class="d-block">Total</small>
                <b>{{ $order->inspections->count() }}</b>
            </div>
            <div class="mx-3 mx-md-5">
                <small class="d-block">Approved</small>
                <b>{{ $order->inspections->where('is_approved', 1)->count() }}</b>
            </div>
            <div>
                <small class="d-block">Required</small>
                <b>{{ $order->job->approved_inspections_required }}</b>
            </div>
        </div>
    </div>

    <x-table>
        <x-slot name="thead">
            <tr>
                <th>Schedule</th>
                <th>Inspector</th>
                <th>Observations</th>
                <th>Status</th>
                <th></th>
            </tr>
        </x-slot>
        @foreach($order->inspections->sortByDesc('scheduled_date')->load('inspector') as $inspection)
        <tr @class(['align-middle' => strlen($inspection->observations) < 100])>
            <td class="text-nowrap pe-5" style="width:1%">{{ $inspection->scheduled_date->format('D d M, Y') }}</td>
            <td class="text-nowrap">{{ $inspection->inspector->name }}</td>
            <td style="min-width:240px; max-width:512px">{{ $inspection->observations }}</td>
            <td>
                <x-badge :color="$inspection->approved_color" class="text-uppercase">{{ $inspection->approved_status }}</x-badge>
            </td>
            <td class="text-nowrap text-end">
                @if( $inspection->hasNotes() )
                <button class="btn btn-outline-primary" data-bs-toggle="tooltip" data-bs-html="true" data-bs-title="- Notes -<br>{{ $inspection->notes }}">
                    <i class="bi bi-chat-square-text"></i>
                </button>    
                @endif

                <a href="{{ route('inspections.edit', [$inspection, 'back' => 'order']) }}" class="btn btn-outline-warning">
                    <i class="bi bi-pencil-fill"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </x-table>
</x-card>
