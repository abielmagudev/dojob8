<x-card>
    <x-table class="text-center align-middle m-0" not-hover>
        <x-slot name="thead">
            <tr>
                @foreach($work_orders_status as $wo_status)
                <th class="fw-normal text-uppercase small text-nowrap">{{ $wo_status }}</th>
                @endforeach
            </tr>
        </x-slot>
        
        <tr>
            @foreach($work_orders_status as $wo_status)
            <td class="fs-3 border-0" style="min-width:128px">
                {{ $work_orders->filter(function ($wo) use ($wo_status) {
                    if($wo_status == 'pending') {
                        return is_null($wo->status);
                    }

                    return $wo->status == $wo_status;
                })->count() }}
            </td>
            @endforeach
        </tr>
    </x-table>
</x-card>
