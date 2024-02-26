<x-card>
    <x-table class="text-center align-middle m-0" not-hover>
        <x-slot name="thead">
            <tr>
                @foreach($all_statuses_work_order as $status)
                <th class="fw-normal text-uppercase text-nowrap small border-0">{{ $status }}</th>
                @endforeach
            </tr>
        </x-slot>
        
        <tr>
            @foreach($all_statuses_work_order as $status)
            <td class="fs-3 border-0" style="min-width:128px">
                {{ $work_orders->filter(function ($wo) use ($status) {
                    return $wo->isStatus($status);
                })->count() }}
            </td>
            @endforeach
        </tr>
    </x-table>
</x-card>
