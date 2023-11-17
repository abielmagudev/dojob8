<x-card class="h-100" title="Inspections">
    <small class="text-secondary">Successful inspections</small>
    <p>1 / {{ $order->job->successful_inspections }}</p>

    <table class="table table-sm table-borderless">
        <tr>
            <td>Inspector</td>
            <td class="text-nowrap ">{{ date('Y-m-d') }}</td>
            <td>
                <div class="badge w-100 text-bg-dark">Pending</div>
            </td>
        </tr>
        <tr>
            <td>Inspector</td>
            <td class="text-nowrap ">{{ date('Y-m-d') }}</td>
            <td>
                <div class="badge w-100 text-bg-danger">Denied</div>
            </td>
        </tr>
        <tr>
            <td>Inspector</td>
            <td class="text-nowrap ">{{ date('Y-m-d') }}</td>
            <td>
                <div class="badge w-100 text-bg-success">Passed</div>
            </td>
        </tr>
        <tr>
            <td>Inspector</td>
            <td class="text-nowrap ">{{ date('Y-m-d') }}</td>
            <td>
                <div class="badge w-100 text-bg-danger">Denied</div>
            </td>
        </tr>
    </table>
</x-card>
