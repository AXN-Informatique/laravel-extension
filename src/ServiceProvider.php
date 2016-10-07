<?php

namespace Axn\Illuminate;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Illuminate\Foundation\AliasLoader;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * The providers to be registered.
     *
     * @var array
     */
    protected $providers = [
        'Axn\Illuminate\Database\DatabaseServiceProvider',
        'Axn\Illuminate\Database\MigrationServiceProvider',
        'Axn\Illuminate\Foundation\Providers\ArtisanServiceProvider',
        'Axn\Illuminate\View\ViewServiceProvider',
    ];

    /**
     * The aliases to be registered.
     *
     * @var array
     */
    protected $aliases = [
        //
    ];

    /**
     * Bootstrap the application services.
     *
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../resources/config/logging.php' => $this->app->configPath() . '/' . 'logging.php',
        ], 'config');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerProviders();

        $this->registerAliases();
    }

    /**
     * Register providers.
     *
     * @return void
     */
    protected function registerProviders()
    {
        foreach ($this->providers as $provider) {
            $this->app->register($provider);
        }
    }

    /**
     * Register aliases.
     *
     * @return void
     */
    protected function registerAliases()
    {
        $loader = AliasLoader::getInstance();

        foreach ($this->aliases as $class => $alias) {
            $loader->alias($class, $alias);
        }
    }
}
