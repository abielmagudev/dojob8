<?php

namespace App\Providers;

// Models
use App\Models\Agency;
use App\Models\Assessment;
use App\Models\Category;
use App\Models\Client;
use App\Models\Contractor;
use App\Models\Crew;
use App\Models\Inspection;
use App\Models\Job;
use App\Models\Media;
use App\Models\Member;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Configuration;
use App\Models\User;
use App\Models\WorkOrder;

// Observers 
use App\Observers\AgencyObserver;
use App\Observers\AssessmentObserver;
use App\Observers\CategoryObserver;
use App\Observers\ClientObserver;
use App\Observers\ContractorObserver;
use App\Observers\CrewObserver;
use App\Observers\InspectionObserver;
use App\Observers\JobObserver;
use App\Observers\MediaObserver;
use App\Observers\MemberObserver;
use App\Observers\PaymentObserver;
use App\Observers\ProductObserver;
use App\Observers\ConfigurationObserver;
use App\Observers\UserObserver;
use App\Observers\WorkOrderObserver;

// Default 
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

        // Models::Observers
        Agency::observe(AgencyObserver::class);
        Assessment::observe(AssessmentObserver::class);
        Category::observe(CategoryObserver::class);
        Client::observe(ClientObserver::class);
        Contractor::observe(ContractorObserver::class);
        Crew::observe(CrewObserver::class);
        Inspection::observe(InspectionObserver::class);
        Job::observe(JobObserver::class);
        Media::observe(MediaObserver::class);
        Member::observe(MemberObserver::class);
        Payment::observe(PaymentObserver::class);
        Product::observe(ProductObserver::class);
        Configuration::observe(ConfigurationObserver::class);
        User::observe(UserObserver::class);
        WorkOrder::observe(WorkOrderObserver::class);
    }
}
