<?php

namespace App\Providers;

use App\Events\CancelHelpRequest;
use App\Events\RevertAcceptedHelpRequest;
use App\Listeners\CancelHelpRequestListener;
use App\Listeners\RevertAcceptedHelpRequestListener;
use App\Listeners\SendEmailVerificationListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

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
        RevertAcceptedHelpRequest::class => [
          RevertAcceptedHelpRequestListener::class
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
