<?php


use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Auth;



class EventServiceProvider extends ServiceProvider
{

public function boot()
{
    parent::boot();

    Event::listen(Login::class, function ($event) {
        $event->user->update(['last_login_at' => now()]);
    });
}
}