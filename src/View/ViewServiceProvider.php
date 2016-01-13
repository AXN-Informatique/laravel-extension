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

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
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

        $blade->extend(function($view, $compiler) {
            $pattern = '/(?<!\w)(\s*)@hasYield(\s*\(.*\))/';

            return preg_replace($pattern, '$1<?php if (array_key_exists($2, \$__env->getSections())): ?>', $view);
        });

        $blade->extend(function($view, $compiler) {
            $pattern = '/(?<!\w)(\s*)@hasNotYield(\s*\(.*\))/';

            return preg_replace($pattern, '$1<?php if (!array_key_exists($2, \$__env->getSections())): ?>', $view);
        });
    }
}
