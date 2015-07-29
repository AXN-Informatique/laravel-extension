<?php

namespace Axn\Illuminate\Database;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class DatabaseServiceProvider extends BaseServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->replaceMySqlConnection();
    }

    /**
     * Remplace l'instance MySqlConnection dans l'IoC par son extension.
     *
     * @return void
     */
    protected function replaceMySqlConnection()
    {
        $this->app->singleton('db.connection.mysql', function($app, array $parameters) {
            list($connection, $database, $prefix, $config) = $parameters;

            return new MySqlConnection($connection, $database, $prefix, $config);
        });
    }
}
