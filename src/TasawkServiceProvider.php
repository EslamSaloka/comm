<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class TasawkServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        include __DIR__ . '/Common/Route/Api.php';
        include __DIR__ . '/Common/Route/Dashboard.php';
        include __DIR__ . '/Common/Route/Front.php';
        include __DIR__ . '/helpers.php';
        // php artisan vendor:publish --tag=helper --force
        // $this->publishes([
        //     __DIR__.'helpers.php' => config_path()
        // ],'helper');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->loadViewsFrom(__DIR__.'/Common/View/Dashboard', 'Common');
    }
}
