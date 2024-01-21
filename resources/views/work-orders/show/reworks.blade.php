<x-card title="{{ $work_order->reworks->count() }} reworks">
    @if( $work_order->qualifiesForRework() )       
    @slot('options')
    <a href="{{ route('work-orders.create', [$work_order->client, 'type' => 'rework', 'bind' => $work_order->id]) }}" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i>
    </a>
    @endslot
    @endif

    @if( $work_order->reworks->count() )
    <?php $work_order->reworks->load(['crew','contractor','job']) ?>
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

        @foreach($work_order->reworks as $rework)
        <tr>
            <td>{{ $rework->scheduled_date_human }}</td>
            <td>
                @include('crews.__.flag', ['crew' => $rework->crew])
            </td>
            <td>
                @include('contractors.__.flag', ['name' => $rework->contractor->alias, 'tooltip' => $rework->contractor->name])
            </td>
            <td>
                {{ $rework->job->name }}
            </td>
            <td>
                @include('work-orders.__.status-flag', ['status' => $rework->status])
            </td>
            <td class="text-end text-nowrap">
                <a href="{{ route('work-orders.show', $rework) }}" class="btn btn-outline-primary btn-sm">
                    <i class="bi bi-eye-fill"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </x-table>
    @endif
</x-card>
