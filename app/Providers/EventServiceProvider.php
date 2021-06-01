<?php

namespace App\Providers;

use App\Comment;
use App\Observers\CommentObserver;
use App\Observers\ProjectObserver;
use App\Observers\TaskObserver;
use App\Project;
use App\Task;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
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
        Comment::observe(CommentObserver::class);
        Project::observe(ProjectObserver::class);
        Task::observe(TaskObserver::class);
        parent::boot();

        //
    }
}
