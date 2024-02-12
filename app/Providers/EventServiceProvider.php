<?php

namespace App\Providers;

// Models / Observers
use App\Models\Client;
use App\Models\Configuration;
use App\Models\Crew;
use App\Models\Inspection;
use App\Models\Agency;
use App\Models\Contractor;
use App\Models\Job;
use App\Models\Member;
use App\Models\User;
use App\Models\WorkOrder;
use App\Observers\ClientObserver;
use App\Observers\ConfigurationObserver;
use App\Observers\CrewObserver;
use App\Observers\InspectionObserver;
use App\Observers\AgencyObserver;
use App\Observers\ContractorObserver;
use App\Observers\JobObserver;
use App\Observers\MemberObserver;
use App\Observers\UserObserver;
use App\Observers\WorkOrderObserver;
// Dependences 
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Agency::observe(AgencyObserver::class);
        Client::observe(ClientObserver::class);
        Configuration::observe(ConfigurationObserver::class);
        Contractor::observe(ContractorObserver::class);
        Crew::observe(CrewObserver::class);
        Inspection::observe(InspectionObserver::class);
        Job::observe(JobObserver::class);
        Member::observe(MemberObserver::class);
        User::observe(UserObserver::class);
        WorkOrder::observe(WorkOrderObserver::class);
    }
}
