<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
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
        \App\Events\ArticlesEvent::class => [
            \App\Listeners\ArticlesEventListener::class,
        ],
        \Illuminate\Auth\Events\Login::class => [ // 사용자가 로그인하면 일어나는 내장 이벤트는 Illuminate\Auth\Events\Login
            \App\Listeners\UsersEventListener::class
        ], 
    ];

    protected $subscribe = [
        \App\Listeners\UsersEventListener::class
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        \Event::listen( //첫번째 인자로 지정한 이벤트가 발생하면, 두번째 인자의 클래스에게 처리를 위임
            \App\Events\ArticleCreated::class,
            \App\Listeners\ArticlesEventListener::class
    );

    }
}
