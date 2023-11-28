<x-card>
    <x-table class="text-center align-middle m-0" not-hover>
        <x-slot name="thead">
            <tr>
                <th class="fw-normal text-uppercase small text-nowrap">Hold on</th>
                <th class="fw-normal text-uppercase small">Started</th>
                <th class="fw-normal text-uppercase small">Done</th>
                <th class="fw-normal text-uppercase small">Canceled</th>
                <th class="fw-normal text-uppercase small">Closed</th>
            </tr>
        </x-slot>
        
        <tr>
            <td class="fs-3 border-0" style="min-width:128px">{{ mt_rand(0, 500) }}</td>
            <td class="fs-3 border-0" style="min-width:128px">{{ mt_rand(0, 500) }}</td>
            <td class="fs-3 border-0" style="min-width:128px">{{ mt_rand(0, 500) }}</td>
            <td class="fs-3 border-0" style="min-width:128px">{{ mt_rand(0, 500) }}</td>
            <td class="fs-3 border-0" style="min-width:128px">{{ mt_rand(0, 500) }}</td>
        </tr>
    </x-table>
</x-card>
