<?php

namespace Axn\Illuminate;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Collective\Html\FormBuilder;
use Collective\Html\HtmlBuilder;
use Illuminate\View\Compilers\BladeCompiler;

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
        $this->app->afterResolving('blade.compiler', function(BladeCompiler $blade) {
            require __DIR__.'/blade-directives.php';
        });

        // HTML Macros (LaravelCollective)
        $this->app->afterResolving('html', function(HtmlBuilder $html) {
            require __DIR__.'/html-macros.php';
        });

        // Form Macros (LaravelCollective)
        $this->app->afterResolving('form', function(FormBuilder $form) {
            require __DIR__.'/form-macros.php';
        });
    }
}
