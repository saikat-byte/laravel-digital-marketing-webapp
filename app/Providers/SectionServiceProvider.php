<?php
// app/Providers/SectionServiceProvider.php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class SectionServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../../config/sections.php', 'sections'
        );
    }

    public function boot()
    {
        $this->publishes([
            __DIR__.'/../../config/sections.php' => config_path('sections.php'),
        ]);
    }
}
