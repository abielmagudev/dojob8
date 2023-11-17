<x-card class="h-100" title="Timeline">  
    <table class="table table-sm table-borderless">
        <tr>
            <td class="text-secondary text-end">Scheduled</td>
            <td>{{ $order->scheduled_date}} {{ $order->scheduled_time }}</td>
        </tr>
        <tr>
            <td class="text-secondary text-end">Started</td>
            <td></td>
        </tr>
        <tr>
            <td class="text-secondary text-end">Finished</td>
            <td></td>
        </tr>
        <tr>
            <td class="text-secondary text-end">Canceled</td>
            <td></td>
        </tr>
        <tr>
            <td class="text-secondary text-end">Closed</td>
            <td></td>
        </tr>
    </table>  
</x-card>
