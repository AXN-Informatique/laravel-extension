<?php

declare(strict_types=1);

namespace Axn\ToolKit;

use Axn\ToolKit\Components\RequiredFieldMarker;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

/**
 * Tool Kit service provider.
 */
class ServiceProvider extends BaseServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'tool-kit');

        Blade::component('required-field-marker', RequiredFieldMarker::class);

        $this->bootBladeDirectives();
    }

    /**
     * Register Blade directives.
     */
    private function bootBladeDirectives(): void
    {
        Blade::directive('nltobr', fn (string $expression): string => \sprintf('<?php echo nl_to_br(e(%s)); ?>', $expression));

        Blade::directive('nltobrcompact', fn (string $expression): string => \sprintf('<?php echo nl_to_br_compact(e(%s)); ?>', $expression));

        Blade::directive('nltop', fn (string $expression): string => \sprintf('<?php echo nl_to_p(e(%s)); ?>', $expression));

        Blade::directive('nltopflat', fn (string $expression): string => \sprintf('<?php echo nl_to_p_flat(e(%s)); ?>', $expression));
    }
}
