<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Events\CommentEvent;
use App\Listeners\CommentListener;
use App\Events\ReactionEvent;
use App\Listeners\ReactionListener;
use Illuminate\Auth\Events\PasswordReset;

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
        // PasswordReset::class => [

        //     sendPasswordResetNotification::class,
        // ],
        CommentEvent::class =>[
            CommentListener::class,
        ],
        ReactionEvent::class =>[
            ReactionListener::class,
        ],
        ReactionCommentEvent::class =>[
            ReactionCommentListener::class,
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
