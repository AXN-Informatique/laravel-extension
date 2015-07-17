<?php

if (!function_exists('capture')) {
    /**
     * Capture et retourne un flux de sortie (un "var_dump" par exemple).
     *
     * @param  string|Closure $callable
     * @param  array          $args
     * @return string
     */
    function capture($callable, array $args = [])
    {
        ob_start();
        call_user_func_array($callable, $args);

        return ob_get_clean();
    }
}

if (!function_exists('write_dump')) {
    /**
     * Enregistre un message dans le fichier "dump.html" dans le dossier "public".
     *
     * @param  mixed   $message
     * @param  boolean $append
     * @return void
     */
    function write_dump($message, $append = false)
    {
        $originalMaxDepth = ini_get('xdebug.var_display_max_depth');
        ini_set('xdebug.var_display_max_depth', -1);

        $formatted = capture('var_dump', [$message])."\n";
        ini_set('xdebug.var_display_max_depth', $originalMaxDepth);

        file_put_contents(public_path().'/dump.html', $formatted, $append ? FILE_APPEND : 0);
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
