<?php

namespace Axn\Illuminate;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Blade Directives
        require __DIR__.'/blade-directives.php';

        // HTML Macros (LaravelCollective)
        require __DIR__.'/html-macros.php';

        // Form Macros (LaravelCollective)
        require __DIR__.'/form-macros.php';
    }
}
