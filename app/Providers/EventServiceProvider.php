<?php

namespace App\Providers;

use App\Events\AcceptedHelpRequest;
use App\Events\CancelHelpRequest;
use App\Events\JoinedAssociation;
use App\Events\RevertAcceptedHelpRequest;
use App\Listeners\AcceptedHelpRequestListener;
use App\Listeners\CancelHelpRequestListener;
use App\Listeners\JoinedAssociationListener;
use App\Listeners\RevertAcceptedHelpRequestListener;
use App\Listeners\SendEmailVerificationListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider {
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class                => [
            SendEmailVerificationListener::class,
        ],
        CancelHelpRequest::class         => [
            CancelHelpRequestListener::class,
        ],
        RevertAcceptedHelpRequest::class => [
            RevertAcceptedHelpRequestListener::class,
        ],
        AcceptedHelpRequest::class       => [
            AcceptedHelpRequestListener::class,
        ],
        JoinedAssociation::class         => [
            JoinedAssociationListener::class,
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
    public function boot() {
        parent::boot();

        //
    }
}
