<?php

use Illuminate\Support\Debug\Dumper;
use Carbon\Carbon;

if (!function_exists('d')) {
    /**
     * Dump les valeurs passées en paramètres à l'aide du Dumper de Laravel,
     * sans terminer le script à la fin et en retournant le résultat au lieu
     * de le rendre directement dans le flux.
     *
     * @param  mixed
     * @return string
     */
    function d()
    {
        ob_start();

        array_map(function($x) {(new Dumper)->dump($x)."\n";}, func_get_args());

        return ob_get_clean();
    }
}

if (!function_exists('vd')) {
    /**
     * Idem d(), mais rend le résultat directement dans le flux comme var_dump().
     *
     * @param  mixed
     * @return void
     */
    function vd()
    {
        array_map(function($x) {(new Dumper)->dump($x)."\n";}, func_get_args());
    }
}

if (!function_exists('dw')) {
    /**
     * Idem d(), mais écrit le résultat dans "public/dump.html".
     *
     * @param  mixed
     * @return void
     */
    function dw()
    {
        $dump = call_user_func_array('d', func_get_args());

        file_put_contents(public_path('dump.html'), $dump, FILE_APPEND);
    }
}


if (!function_exists('v')) {
    /**
     * Retourne la valeur d'une variable. Si celle-ci n'existe pas (variable non
     * définie ou chaîne vide), une valeur par défaut est retournée à la place.
     *
     * ---------------------------------------------------------------------
     * ATTENTION : Si la variable n'existe pas, le passage par référence a pour
     * conséquence de la créer (avec valeur NULL), ce qui peut être problématique
     * si $var est une référence à une dimension d'un tableau ou à un attribut
     * d'objet car ces éléments seront alors créés...
     *
     * Exemple :
     *   Si $arr = [] et que l'on fait : v($arr['a']['b'])
     *   alors $arr vaut à présent : ['a' => ['b' => null]]
     *
     * Préférer dans ce cas l'utilisation du helper vv().
     * ---------------------------------------------------------------------
     *
     * @param  mixed               &$var
     * @param  mixed               $default  Valeur à retourner si $var non défini ou chaîne vide
     * @param  string|Closure|null $callback Callback sur $var si $var défini
     * @return mixed
     */
    function v(&$var, $default = null, $callback = null)
    {
        if (!isset($var) || $var === '') {
            return $default;
        }
        elseif (is_callable($callback)) {
            return call_user_func($callback, $var);
        }
        else {
            return $var;
        }
    }
}

if (!function_exists('vv')) {
    /**
     * Idem helper v() mais avec un paramètre $key pour accéder aux dimensions
     * d'un tableau ou attributs d'un objet, évitant ainsi la création de toute
     * la profondeur si celle-ci n'existe pas.
     *
     * @param  mixed               &$var
     * @param  string              $key
     * @param  mixed               $default  Valeur à retourner si $var non défini ou chaîne vide
     * @param  string|Closure|null $callback Callback sur $var si $var défini
     * @return mixed
     */
    function vv(&$var, $key, $default = null, $callback = null)
    {
        if (!isset($var) || !is_array($var) && !is_object($var)) {
            return $default;
        }

        $data = data_get($var, $key);

        return v($data, $default, $callback);
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
