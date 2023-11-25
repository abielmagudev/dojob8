<?php

namespace App\Providers;

// Models / Observers
use App\Models\Client;
use App\Models\Crew;
use App\Models\Inspection;
use App\Models\Inspector;
use App\Models\Intermediary;
use App\Models\Job;
use App\Models\Member;
use App\Models\User;
use App\Observers\ClientObserver;
use App\Observers\CrewObserver;
use App\Observers\InspectionObserver;
use App\Observers\InspectorObserver;
use App\Observers\IntermediaryObserver;
use App\Observers\JobObserver;
use App\Observers\MemberObserver;
use App\Observers\UserObserver;
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

        Client::observe(ClientObserver::class);
        Crew::observe(CrewObserver::class);
        Inspection::observe(InspectionObserver::class);
        Inspector::observe(InspectorObserver::class);
        Intermediary::observe(IntermediaryObserver::class);
        Job::observe(JobObserver::class);
        Member::observe(MemberObserver::class);
        User::observe(UserObserver::class);
    }
}
