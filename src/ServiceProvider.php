<?php

declare(strict_types=1);

namespace Axn\ToolKit;

use Axn\ToolKit\Components\RequiredFieldMarker;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'tool-kit');

        Blade::component('required-field-marker', RequiredFieldMarker::class);

        $this->bootBladeDirectives();
    }

    private function bootBladeDirectives(): void
    {
        Blade::directive('nltop', fn ($expression): string => "<?php echo nl_to_p(e($expression)); ?>");

        Blade::directive('nltobr', fn ($expression): string => "<?php echo nl_to_br(e($expression)); ?>");
    }
}
