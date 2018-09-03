<?php

use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Debug\HtmlDumper;
use Symfony\Component\VarDumper\Cloner\VarCloner;

if (!function_exists('dump_get')) {
    /**
     * Returns the result of a dump (Laravel HtmlDumper).
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

if (!function_exists('carbon')) {
    /**
     * Create a Carbon instance from a date string, a DateTime instance or a timestamp.
     *
     * @param  \DateTime|int|string|null $date
     * @param  string|null $format
     * @param  \DateTimeZone|string|null $tz
     * @return \Illuminate\Support\Carbon|Carbon\Carbon
     * */
    function carbon($date = null, $format = null, $tz = null)
    {
        $carbonClass = '\\Illuminate\\Support\\Carbon';

        if (!class_exists($carbonClass)) {
            $carbonClass = '\\Carbon\\Carbon';
        }

        if (empty($date)) {
            return $carbonClass::now($tz);
        }

        if ($date instanceof \DateTime) {
            $carbon = $carbonClass::instance($date);

            if (!is_null($tz)) {
                $carbon->setTimezone($tz);
            }

            return $carbon;
        }

        if (is_int($date) || ctype_digit($date)) {
            return $carbonClass::createFromTimestamp($date, $tz);
        }

        if (!empty($format)) {
            return $carbonClass::createFromFormat($format, $date, $tz);
        }

        return $carbonClass::parse($date, $tz);
    }
}

if (!function_exists('collect_models')) {
    /**
     * Create a collection of Eloquent models.
     *
     * @param  array[\Illuminate\Database\Eloquent\Model] $models
     * @return EloquentCollection
     */
    function collect_models($models = null)
    {
        return new EloquentCollection($models);
    }
}

if (!function_exists('nl_to_p')) {
    /**
     * Convert new lines into paragraphs.
     *
     * @param  string $str
     * @return string
     */
    function nl_to_p($str)
    {
        // Convert all line-endings to UNIX format
        $str = str_replace("\r\n", "\n", $str);
        $str = str_replace("\r", "\n", $str);

        // Don't allow out-of-control blank lines
        $str = preg_replace("/\n{2,}/", "\n\n", $str);

        // Replace multiple linebreaks by paragraphs
        $str = preg_replace('/\n(\s*\n)+/', '</p><p>', $str);

        // Replace the single linebreaks by <br> elements
        $str = nl2br($str);

        return '<p>'.$str.'</p>';
    }
}

if (!function_exists('number_fr')) {
    /**
     * Returns a number in french format.
     *
     * @param  float $value
     * @param  int $decimals
     * @return string
     */
    function number_fr($value, $decimals = 0)
    {
        return number_format($value, $decimals, ',', ' ');
    }
}
