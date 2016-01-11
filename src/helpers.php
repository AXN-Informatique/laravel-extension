<?php

use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Debug\HtmlDumper;
use Symfony\Component\VarDumper\Cloner\VarCloner;
use Carbon\Carbon;

if (!function_exists('dump_get')) {
    /**
     * Retourne le résultat d'un dump obtenu à l'aide du dumper HTML de Laravel.
     *
     * @param  mixed
     * @return string
     */
    function dump_get()
    {
        ob_start();

        foreach (func_get_args() as $var) {
            (new HtmlDumper)->dump( (new VarCloner)->cloneVar($var) );
        }

        return ob_get_clean();
    }
}

if (!function_exists('dump_put')) {
    /**
     * Écrit dans "public/dump.html" le résultat d'un dump obtenu à l'aide
     * du dumper HTML de Laravel
     *
     * @param  mixed
     * @return void
     */
    function dump_put()
    {
        ob_start();

        foreach (func_get_args() as $var) {
            (new HtmlDumper)->dump( (new VarCloner)->cloneVar($var) );
        }

        file_put_contents(public_path('dump.html'), ob_get_clean(), FILE_APPEND);
    }
}

if (!function_exists('v')) {
    /**
     * Tente de retourner la valeur d'une variable, sans générer d'erreur
     * si celle-ci n'existe pas (grâce au passage par référence).
     *
     * @param  mixed &$var
     * @param  mixed $default
     * @return mixed
     */
    function v(&$var, $default = null)
    {
        return isset($var) ? $var : $default;
    }
}

if (!function_exists('carbon')) {
    /**
     * Crée une instance Carbon à partir d'une date ou d'un timestamp.
     *
     * @param  string|null              $date
     * @param  string|null              $format
     * @param  DateTimeZone|string|null $tz
     * @return Carbon|null
     */
    function carbon($date = null, $format = null, $tz = null)
    {
        if (!empty($format)) {
            return Carbon::createFromFormat($format, $date, $tz);
        } else {
            return Carbon::parse($date, $tz);
        }
    }
}

if (!function_exists('collect_models')) {
    /**
     * Crée une collection de modèles (entités Eloquent).
     *
     * @param  array[\Illuminate\Database\Eloquent\Model] $models
     * @return EloquentCollection
     */
    function collect_models($models = null)
    {
        return new EloquentCollection($models);
    }
}
