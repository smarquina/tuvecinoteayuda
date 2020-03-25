<?php

namespace App\Providers;

use App\Events\CancelHelpRequest;
use App\Listeners\CancelHelpRequestListener;
use Illuminate\Auth\Events\Registered;
use App\Listeners\SendEmailVerificationListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationListener::class,
        ],
        CancelHelpRequest::class => [
          CancelHelpRequestListener::class
        ],
//        'Illuminate\Auth\Events\Verified' => [
//            'App\Listeners\VerifiedUserListener',
//        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
