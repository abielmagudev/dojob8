<x-card title="Jobs">

    @foreach($jobs->sortBy('name') as $job)    
     
    <?php 
            
    $work_orders_count_by_job = $work_orders->filter(function ($wo) use ($job) {
        return $wo->job_id == $job->id;
    })->count();

    $work_orders_percent_by_job = $work_orders->count() ? ceil(($work_orders_count_by_job / $work_orders->count()) * 100) : 0;

    ?>

    <div class="row align-items-center mb-3">
        <div class="col-xl col-xl-3 mb-1 mb-xl-0">
            <span>{{ $job->name }}</span>
        </div>
        <div class="col-xl col-xl-9">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1 me-3">
                    <div class="progress" role="progressbar" aria-label="{{ $job->name }}" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="height:22px">
                        <div class="progress-bar" style="color:#333; width:{{ $work_orders_percent_by_job }}%"></div>
                    </div>
                </div>
                <div style="width:56px">
                    <b class="badge text-bg-primary w-100">{{ $work_orders_count_by_job }}</b>
                </div>
            </div>
        </div>
    </div>
    @endforeach

</x-card>
