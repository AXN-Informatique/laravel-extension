<?php

namespace Axn\ToolKit;

use Axn\ToolKit\Components\RequiredFieldMarker;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'tool-kit');

        Blade::component('required-field-marker', RequiredFieldMarker::class);

        $this->bootBladeDirectives();
    }

    private function bootBladeDirectives()
    {
        Blade::directive('nltop', function ($expression) {
            return "<?php echo nl_to_p(e($expression)); ?>";
        });

        Blade::directive('nltobr', function ($expression) {
            return "<?php echo nl_to_br(e($expression)); ?>";
        });
    }
}
