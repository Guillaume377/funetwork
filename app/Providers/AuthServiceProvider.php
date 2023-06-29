<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Post::class => PostPolicy::class, //intermédiaire entre vue (home.blade) et policy (PostPolicy)
        Comment::class => CommentPolicy::class,//intermédiaire entre vue (home.blade) et policy (CommentPolicy)
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
