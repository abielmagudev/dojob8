<x-card>
    <x-table class="text-center align-middle m-0" not-hover>
        <x-slot name="thead">
            <tr>
                @foreach($all_statuses_work_order as $status)
                <th class="fw-normal text-uppercase small text-nowrap">{{ $status }}</th>
                @endforeach
            </tr>
        </x-slot>
        
        <tr>
            @foreach($all_statuses_work_order as $status)
            <td class="fs-3 border-0" style="min-width:128px">
                {{ $work_orders->filter(function ($wo) use ($status) {
                    if($status == 'pending') {
                        return is_null($wo->status);
                    }

                    return $wo->status == $status;
                })->count() }}
            </td>
            @endforeach
        </tr>
    </x-table>
</x-card>
