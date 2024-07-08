<?php

namespace App\Providers;

use App\Models\Idea;
use App\Models\User;
use App\Policies\IdeaPolicy;
use App\Policies\UserPolicy;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
        Gate::define('admin', function (User $user): bool {
            return $user->is_admin;
        });

        Gate::define('is_idea_owner_or_admin', function (User $user, Idea $idea): bool {
            return ((bool) $user->is_admin || $user->id === $idea->user_id);
        });

        Gate::policy(Idea::class, IdeaPolicy::class);
        Gate::policy(User::class, UserPolicy::class);
    }
}
