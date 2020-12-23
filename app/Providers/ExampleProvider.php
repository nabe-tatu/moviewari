<?php

namespace App\Providers;

use App\Example;
use Illuminate\Support\ServiceProvider;

class ExampleProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('Example',Example::class);
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
