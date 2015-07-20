<?php

use Illuminate\Support\Debug\Dumper;

if (!function_exists('dw')) {
    /**
     * Dump les valeurs passées en paramètres et écrit le résultat dans le fichier
     * public/dump.html.
     *
     * @return void
     */
    function dw()
    {
        ob_start();

        foreach (func_get_args() as $arg) {
            (new Dumper)->dump($arg);
            echo "\n";
        }

        file_put_contents(public_path().'/dump.html', ob_get_clean(), FILE_APPEND);
    }
}

if (!function_exists('v')) {
    /**
     * Retourne la valeur d'une variable si celle-ci existe. Si celle-ci n'existe
     * pas (variable non définie ou chaîne vide), une valeur par défaut est retournée.
     *
     * ATTENTION : Le fait de passer par référence la variable à tester a pour
     * conséquence de la créer en mémoire (NULL), ce qui peut être problématique,
     * notamment avec les tableaux.
     *
     * @param  mixed               &$value
     * @param  mixed               $defaultValue Valeur à retourner si $value n'est pas défini.
     * @param  string|Closure|null $callback     Fonction de callback sur $value si défini.
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
