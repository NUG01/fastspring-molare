<?php

namespace NUG01\Molare;

use Illuminate\Support\ServiceProvider;

class MolareServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
    }

    public function register()
    {
        // $this->app->bind('molare', function ($app) {
        //     return new Molare();
        // });
    }
}
