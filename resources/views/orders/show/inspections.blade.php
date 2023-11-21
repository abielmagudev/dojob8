<x-card title="Inspections">
    <x-slot name="options">
        <div class="d-none d-lg-inline-block">
            <small class="me-3">Total: <b>{{ $order->inspections->count() }}</b></small>
            <small class="me-3">Approved: <b>{{ $order->inspections->where('is_approved', 1)->count() }}</b></small>
            <small class="me-3">Required: <b>{{ $order->job->approved_inspections_required }}</b></small>
        </div>
        <a href="{{ route('inspections.create', $order) }}" class="btn btn-primary">
            <b>+</b>
        </a>
    </x-slot>

    <div class="d-flex justify-content-around text-center text-uppercase mb-3 d-lg-none">
        <div class="me-3">
            <small class="d-block text-secondary">Total</small>
            <b>{{ $order->inspections->count() }}</b>
        </div>
        <div class="me-3">
            <small class="d-block text-secondary">Approved</small>
            <b>{{ $order->inspections->where('is_approved', 1)->count() }}</b>
        </div>
        <div>
            <small class="d-block text-secondary">Required</small>
            <b>{{ $order->job->approved_inspections_required }}</b>
        </div>
    </div>

    <x-table class="align-middle">
        @foreach($order->inspections->sortByDesc('scheduled_date')->load('inspector') as $inspection)
        <tr>
            <td class="text-center">
                <x-custom.badge-status :color="$inspection->status_color">{{ $inspection->status_label }}</x-custom.badge-status>
            </td>
            <td class="text-center text-nowrap">{{ $inspection->scheduled_date->format('D d M, Y') }}</td>
            <td class="text-center">{{ $inspection->inspector->name }}</td>
            <td class="text-center">
                @if( $inspection->hasObservations() )
                <span class="badge text-bg-primary" data-bs-toggle="tooltip" data-bs-html="true" data-bs-title="{{ $inspection->observations }}">
                    Observations
                </span>    
                           
                @endif
            </td>
            <td class="text-end">
                <a href="{{ route('inspections.edit', [$inspection, 'back' => 'order']) }}" class="btn btn-outline-warning">
                    <i class="bi bi-pencil-fill"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </x-table>
</x-card>
