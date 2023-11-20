<x-card class="h-100" title="Inspections">
    <x-slot name="options">
        <a href="{{ route('inspections.create', $order) }}" class="btn btn-primary">
            <b>+</b>
        </a>
    </x-slot>

    <div class="hstack justify-content-between text-center text-uppercase ">
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
            <b>{{ $order->job->successful_inspections }}</b>
        </div>
    </div>
    <br>

    <x-table class="align-middle">
        @foreach($order->inspections->sortByDesc('id') as $inspection)
        <tr>
            <td class="text-nowrap ">{{ $inspection->scheduled_date->format('D d M, Y') }}</td>
            <td>{{ $inspection->inspector->name }}</td>
            <td>
                <span class="badge text-uppercase w-100 text-bg-{{ $inspection->status_color }}">{{ $inspection->status_label }}</span>
            </td>
            <td class="text-end">
                <a href="{{ route('inspections.edit', [$inspection, 'back' => 'order']) }}" class="btn btn-warning">
                    <i class="bi bi-pencil-fill"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </x-table>
</x-card>
