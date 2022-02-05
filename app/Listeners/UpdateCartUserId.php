<?php

namespace App\Listeners;

use CartRepository;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\App;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateCartUserId
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(Login $event)
    {
        $user = $event->user;
        $cart = App::make(CartRepository::class);
        if(method_exists($cart, 'setCartUserId')){
        $cart->setCartUserId($user->id);
        }
    }
}
