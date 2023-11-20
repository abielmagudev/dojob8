<x-card class="h-100" title="Inspections">
    <x-slot name="options">
        <a href="{{ route('inspections.create', $order) }}" class="btn btn-primary">
            <b>+</b>
        </a>
    </x-slot>

    <div class="hstack justify-content-around text-center text-uppercase">
        <div>
            <small class="d-block text-secondary">Total</small>
            <b>{{ $order->inspections->count() }}</b>
        </div>
        <div>
            <small class="d-block text-secondary">Approved</small>
            <b>{{ $order->inspections->where('is_approved', 1)->count() }}</b>
        </div>
        <div>
            <small class="d-block text-secondary">Required</small>
            <b>{{ $order->job->approved_inspections_required }}</b>
        </div>
    </div>
    <br>

    <x-table class="align-middle">
        @foreach($order->inspections->sortByDesc('scheduled_date')->load('inspector') as $inspection)
        <tr>
            <td style="max-width:64px">
                <x-custom.badge-status :color="$inspection->status_color">{{ $inspection->status_label }}</x-custom.badge-status>
            </td>
            <td class="text-nowrap ">{{ $inspection->scheduled_date->format('D d M, Y') }}</td>
            <td>{{ $inspection->inspector->name }}</td>
            <td class="text-end">
                <a href="{{ route('inspections.edit', [$inspection, 'back' => 'order']) }}" class="btn btn-outline-warning">
                    <i class="bi bi-pencil-fill"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </x-table>
</x-card>
