<?php

declare(strict_types=1);

namespace Axn\ToolKit;

use Axn\ToolKit\Components\RequiredFieldMarker;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'tool-kit');

        Blade::component('required-field-marker', RequiredFieldMarker::class);

        $this->bootBladeDirectives();
    }

    private function bootBladeDirectives()
    {
        Blade::directive('nltop', fn ($expression) => "<?php echo nl_to_p(e($expression)); ?>");

        Blade::directive('nltobr', fn ($expression) => "<?php echo nl_to_br(e($expression)); ?>");
    }
}
