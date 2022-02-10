<?php

namespace App\Providers;

use App\Events\OrderCreated;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use App\Listeners\UpdateCartUserId;
use App\Listeners\DeleteCartCookieId;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use App\Listeners\UpdateUserLastLoginAt;
use App\Listeners\SendOrderCreatedEmailToAdmin;
use App\Listeners\SendOrderCreatedNotification;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

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
        Login::class => [
            UpdateUserLastLoginAt::class,
            UpdateCartUserId::class,
        ],
        Logout::class => [
            DeleteCartCookieId::class,
        ],
        OrderCreated::class => [
            // SendOrderCreatedEmailToAdmin::class,
            SendOrderCreatedNotification::class,
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
