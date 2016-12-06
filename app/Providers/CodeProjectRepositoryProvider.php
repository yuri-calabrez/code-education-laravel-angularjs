<?php

namespace CodeProject\Providers;

use Illuminate\Support\ServiceProvider;
use CodeProject\Repositories;

class CodeProjectRepositoryProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Repositories\ClientRepositoryInterface::class, Repositories\ClientRepositoryEloquent::class);
        $this->app->bind(Repositories\ProjectRepositoryInterface::class, Repositories\ProjectRepositoryEloquent::class);
    }
}
