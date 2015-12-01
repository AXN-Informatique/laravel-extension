<?php

use Illuminate\Support\Debug\Dumper;
use Illuminate\Support\Debug\HtmlDumper;
use Symfony\Component\VarDumper\VarDumper;
use Symfony\Component\VarDumper\Cloner\VarCloner;
use Carbon\Carbon;

/*
 * Permet d'avoir un rendu HTML aux couleurs de Laravel avec VarDumper::dump()
 * et dump() (composant "symfony/var-dumper").
 */
VarDumper::setHandler(function($var) {
    (new Dumper)->dump($var);
});

if (!function_exists('dump_get')) {
    /**
     * Dump les valeurs passées en paramètres à l'aide du dumper HTML de Laravel,
     * puis retourne le résultat.
     *
     * @param  mixed
     * @return string
     */
    function dump_get()
    {
        ob_start();

        foreach (func_get_args() as $var) {
            (new HtmlDumper)->dump((new VarCloner)->cloneVar($var));
        }

        return ob_get_clean();
    }
}

if (!function_exists('dump_put')) {
    /**
     * Dump les valeurs passées en paramètres à l'aide du dumper HTML de Laravel,
     * puis écrit le résultat dans le fichier "public/dump.html".
     *
     * @param  mixed
     * @return void
     */
    function dump_put()
    {
        ob_start();

        foreach (func_get_args() as $var) {
            (new HtmlDumper)->dump((new VarCloner)->cloneVar($var));
        }

        file_put_contents(public_path('dump.html'), ob_get_clean(), FILE_APPEND);
    }
}

if (!function_exists('v')) {
    /**
     * Retourne la valeur d'une variable, si celle-ci existe et n'est pas une
     * chaîne vide, ou une valeur par défaut sinon.
     *
     * Utiliser le paramètre $key pour accéder aux profondeurs d'un tableau/objet !
     * Exemple : v($arr, 'a.b') accède à $arr['a']['b'], ou $arr['a']->b, etc.
     *
     * @param  mixed               &$var
     * @param  string|null         $key      Profondeur dans $var
     * @param  mixed               $default  À retourner si valeur non définie ou chaîne vide
     * @param  string|Closure|null $callback Callback sur la valeur si définie
     * @return mixed
     */
    function v(&$var, $key = null, $default = null, $callback = null)
    {
        $data = data_get($var, $key);

        if ($data === null || $data === '') {
            return $default;
        } elseif (is_callable($callback)) {
            return call_user_func($callback, $data);
        } else {
            return $data;
        }
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
