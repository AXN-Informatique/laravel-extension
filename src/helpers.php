<?php

use Illuminate\Support\Debug\Dumper;

if (!function_exists('vd')) {
    /**
     * Dump les valeurs passées en paramètres à l'aide du Dumper de Laravel,
     * sans terminer le script à la fin.
     *
     * @param  mixed
     * @return void
     */
    function vd()
    {
        array_map(function($x) { (new Dumper)->dump($x)."\n"; }, func_get_args());
    }
}

if (!function_exists('dw')) {
    /**
     * Dump les valeurs passées en paramètres à l'aide du Dumper de Laravel,
     * puis écrit le résultat dans le fichier "public/dump.html".
     *
     * @param  mixed
     * @return void
     */
    function dw()
    {
        ob_start();

        call_user_func_array('vd', func_get_args());

        file_put_contents(public_path().'/dump.html', ob_get_clean(), FILE_APPEND);

    }
}

if (!function_exists('v')) {
    /**
     * Retourne la valeur d'une variable. Si celle-ci n'existe pas (variable non
     * définie ou chaîne vide), une valeur par défaut est retournée à la place.
     *
     * ATTENTION : Si la variable n'existe pas, le passage par référence a pour
     * conséquence de la créer ! (avec valeur NULL)
     *
     * @param  mixed               &$value
     * @param  mixed               $defaultValue Valeur à retourner si $value non défini
     * @param  string|Closure|null $callback     Callback sur $value si $value défini
     * @return type
     */
    function v(&$value, $defaultValue = null, $callback = null)
    {
        if (!isset($value) || $value === '') {
            $value = $defaultValue;
        }
        elseif (is_callable($callback)) {
            $value = call_user_func($callback, $value);
        }

        return $value;
    }
}

if (!function_exists('carbon')) {
    /**
     * Crée une instance Carbon à partir d'une date ou d'un timestamp.
     *
     * @param  string|null              $date
     * @param  string|null              $format
     * @param  DateTimeZone|string|null $tz
     * @return Carbon\Carbon|null
     */
    function carbon($date = null, $format = null, $tz = null)
    {
        if (!empty($format)) {
            return Carbon\Carbon::createFromFormat($format, $date, $tz);
        } else {
            return Carbon\Carbon::parse($date, $tz);
        }
    }
}
