<?php

namespace Axn\Illuminate\View;

use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    public function boot()
    {
        $this->registerBladeDirective();
    }

    /**
     * Implement custom Blade directives.
     *
     * @return void
     */
    public function registerBladeDirective()
    {
        $blade = $this->app['view']->getEngineResolver()->resolve('blade')->getCompiler();

        $blade->directive('hasYield', function($section) {
            return "<?php if (array_key_exists($section, app('view')->getSections())): ?>";
        });
    }
}
