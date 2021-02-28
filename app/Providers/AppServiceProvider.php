<?php

namespace App\Providers;

use App\Repositories\MediaRepository;
use App\Repositories\MediaRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Class & interface binding
        $this->app->singleton(MediaRepositoryInterface::class, MediaRepository::class);
    }
}
