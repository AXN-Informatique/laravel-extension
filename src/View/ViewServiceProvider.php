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
        $this->registerBladeDirectives();
    }

    /**
     * Implement custom Blade directives.
     *
     * @return void
     */
    public function registerBladeDirectives()
    {
        $blade = $this->app['view']->getEngineResolver()->resolve('blade')->getCompiler();

        $blade->extend(function($view, $compiler) {
            $pattern = '/(?<!\w)(\s*)@(hasYield|hasyield)(\s*\(.*\))/';

            return preg_replace($pattern, '$1<?php if (array_key_exists($3, \$__env->getSections())): ?>', $view);
        });

        $blade->extend(function($view, $compiler) {
            $pattern = '/(?<!\w)(\s*)@(hasNotYield|hasnotyield|doesntHaveYield|doesnthaveyield)(\s*\(.*\))/';

            return preg_replace($pattern, '$1<?php if (!array_key_exists($3, \$__env->getSections())): ?>', $view);
        });
    }
}
