<?php

namespace Axn\Illuminate\Database;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Illuminate\Database\Query\Builder as QueryBuilder;

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

        if (version_compare($this->app->version(), '5.1.*', '>=')) {
            $this->registerQueryBuilderMacros();
        }
    }

    /**
     * Remplace l'instance MySqlConnection dans l'IoC par son extension.
     *
     * @return void
     */
    protected function replaceMySqlConnection()
    {
        $this->app->bind('db.connection.mysql', function($app, array $parameters) {
            list($connection, $database, $prefix, $config) = $parameters;

            return new MySqlConnection($connection, $database, $prefix, $config);
        });
    }

    /**
     * Ajoute des extensions (macros) au Query Builder.
     *
     * @return void
     */
    protected function registerQueryBuilderMacros()
    {
        // Tri naturel
        QueryBuilder::macro(
            'orderByNatural',
            function($column, $direction = 'asc') {
                $column    = $this->grammar->wrap($column);
                $direction = strtolower($direction) == 'asc' ? 'asc' : 'desc';

                // http://kumaresan-drupal.blogspot.fr/2012/09/natural-sorting-in-mysql-or.html
                return $this->orderByRaw(
                      "$column + 0 <> 0 ".($direction == 'asc' ? 'desc' : 'asc').", "
                    . "$column + 0 $direction, "
                    . "$column $direction"
                );
            }
        );
    }
}
