<?php

namespace App\Providers;

use App\Models\User;
use App\Repositories\Contracts\ToolRepositoryInterface;
use App\Repositories\ToolRepository;
use App\Services\Contracts\FileStorageInterface;
use App\Services\FileStorageService;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(FileStorageInterface::class, FileStorageService::class);
        $this->app->bind(ToolRepositoryInterface::class, ToolRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('operator', function (User $user) {
            return $user->role_id === 1;
        });

        Gate::define('administrator', function (User $user) {
            return $user->role_id === 2;
        });
    }
}
