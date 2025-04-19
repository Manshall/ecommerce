<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Illuminate\Support\ServiceProvider;

class FilamentServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Filament::serving(function () {
            // Menambahkan middleware admin di route Filament
            $this->app['router']->pushMiddlewareToGroup('web', \App\Http\Middleware\AdminAuthenticate::class);
        });
    }
}

