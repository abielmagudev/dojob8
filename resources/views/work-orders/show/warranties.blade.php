<x-card title="{{ $work_order->warranties->count() }} warranties">
    @if( $work_order->qualifiesForWarranty() )       
    @slot('options')
    <a href="{{ route('work-orders.create', [$work_order->client, 'type' => 'warranty', 'bind' => $work_order->id]) }}" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i>
    </a>
    @endslot
    @endif

    @if( $work_order->warranties->count() )
    <?php $work_order->warranties->load(['crew','contractor','job']) ?>
    <x-table class="align-middle">
        @slot('thead')
        <tr>
            <th>Scheduled</th>
            <th>Crew</th>
            <th>Contractor</th>
            <th>Job</th>
            <th>Status</th>
            <th></th>
        </tr>
        @endslot

        @foreach($work_order->warranties as $warranty)
        <tr>
            <td>{{ $warranty->scheduled_date_human }}</td>
            <td>
                @include('crews.__.flag', ['crew' => $warranty->crew])
            </td>
            <td>
                @include('contractors.__.flag', ['name' => $warranty->contractor->alias, 'tooltip' => $warranty->contractor->name])
            </td>
            <td>
                {{ $warranty->job->name }}
            </td>
            <td>
                @include('work-orders.__.status-flag', ['status' => $warranty->status])
            </td>
            <td class="text-end text-nowrap">
                <a href="{{ route('work-orders.show', $warranty) }}" class="btn btn-outline-primary btn-sm">
                    <i class="bi bi-eye-fill"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </x-table>
    @endif
</x-card>
