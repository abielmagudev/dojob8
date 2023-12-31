<x-card>  
    <table class="table table-sm table-borderless">
        <tr>
            <td class="text-secondary text-end">Scheduled</td>
            <td>
                <span class="d-block">{{ $work_order->scheduled_date_human }}</span>
                <span class="d-block">{{ $work_order->scheduled_time_human }}</span>
                <span class="d-block">username</span>
            </td>
        </tr>
        <tr>
            <td class="text-secondary text-end">Started</td>
            <td>
                <span class="d-block">{{ now() }}</span>
                <span class="d-block">username</span>
            </td>
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
            <td>
                <span class="d-block">{{ now() }}</span>
                <span class="d-block">username</span>
            </td>
        </tr>
    </table>  
</x-card>
