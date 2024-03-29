<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Observers\SocietyObserver;
use App\Models\Society;
use App\Observers\BlockObserver;
use App\Models\Block;
use App\Observers\PlotObserver;
use App\Models\Plot;
use App\Observers\FlatObserver;
use App\Models\Flat;
use App\Observers\MaintenanceObserver;
use App\Models\Maintenance;

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
        Society::observe(SocietyObserver::class);
        Block::observe(BlockObserver::class);
        Plot::observe(PlotObserver::class);
        Flat::observe(FlatObserver::class);
        Maintenance::observe(MaintenanceObserver::class);
    }
}
