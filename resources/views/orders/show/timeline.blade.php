<x-card class="h-100" title="Timeline">  
    <table class="table table-sm table-borderless">
        <tr>
            <td class="text-secondary text-end">Scheduled</td>
            <td class="text-nowrap">{{ $order->scheduled_date_human }} {{ $order->scheduled_time_human }}</td>
        </tr>
        <tr>
            <td class="text-secondary text-end">Started</td>
            <td class="text-nowrap"></td>
        </tr>
        <tr>
            <td class="text-secondary text-end">Finished</td>
            <td class="text-nowrap"></td>
        </tr>
        <tr>
            <td class="text-secondary text-end">Canceled</td>
            <td class="text-nowrap"></td>
        </tr>
        <tr>
            <td class="text-secondary text-end">Closed</td>
            <td class="text-nowrap"></td>
        </tr>
    </table>  
</x-card>
