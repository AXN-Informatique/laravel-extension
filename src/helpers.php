<?php

use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\HtmlString;

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

if (!function_exists('str_html')) {
    /**
     * Instantiate HtmlString
     *
     * @param string $str
     * @return \Illuminate\Support\HtmlString
     */
    function str_html($str)
    {
        return new HtmlString($str);
    }
}

if (!function_exists('linebreaks')) {
    /**
     * Convert all line-endings to UNIX format ;
     * ie. replace "\r\n" and "\r" by "\n".
     *
     * @param string $str String to transform
     * @return string
     */
    function linebreaks($str)
    {
        return str_replace(["\r\n", "\r" ], ["\n", "\n"], $str);
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
        $str = linebreaks($str);

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

if (!function_exists('compute_dec_to_time')) {
    /**
     * Decimal to time calculation
     *
     * 1.75 => ['hours' => 1, 'minutes' => 45, 'seconds' => 0]
     *
     * @param  string|float $dec
     * @return array
     */
    function compute_dec_to_time($dec)
    {
        // prevent french notation
        $dec = str_replace(',', '.', $dec);

        // start by converting to seconds
        $seconds = ($dec * 3600);

        // we're given hours, so let's get those the easy way
        $hours = floor($dec);

        // since we've "calculated" hours, let's remove them from the seconds variable
        $seconds -= $hours * 3600;

        // calculate minutes left
        $minutes = floor($seconds / 60);

        // finaly, get the rest of seconds
        $seconds = $seconds % 60;

        return compact('hours', 'minutes', 'seconds');
    }
}

if (!function_exists('convert_dec_to_time')) {
    /**
     * Decimal to time conversion
     *
     * convert_dec_to_time(1.75)
     * => 01:45:00
     *
     * convert_dec_to_time(1.75, '%2$s:%3$s')
     * => 45:00
     *
     * @param  string|float $dec
     * @param  string $pattern ('%s:%s:%s')
     * @return string
     */
    function convert_dec_to_time($dec, $pattern = '%s:%s:%s')
    {
        $time = compute_dec_to_time($dec);

        // return the time formatted HH:MM:SS
        $pad = function ($value) {
            return str_pad($value, 2, 0, STR_PAD_LEFT);
        };

        return sprintf(
            $pattern,
            $pad($time['hours']),
            $pad($time['minutes']),
            $pad($time['seconds'])
        );
    }
}
