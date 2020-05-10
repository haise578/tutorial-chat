<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class PostRepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('App\Repositories\PostInterface', 'App\Repositories\PostEloquent');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
