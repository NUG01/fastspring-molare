<?php

namespace NUG01\Molare;

use Illuminate\Support\ServiceProvider;

class MolareServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
    }

    public function register()
    {

    }
}
