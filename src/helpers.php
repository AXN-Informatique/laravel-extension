<?php

declare(strict_types=1);

use Axn\ToolKit\Enums\AppEnv;
use Axn\ToolKit\MimeTypeToFontAwesomeIcon;
use Axn\ToolKit\VersionNumber;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Support\Carbon;
use Illuminate\Support\HtmlString;

if (! function_exists('app_env_enum')) {
    /**
     * Returns a standardized enumeration of the application environment
     * based on the "app.env" configuration variable.
     *
     * Note that the return value is static, it always returns the first value in the same request.
     * If the environment is modified at runtime, this will not be taken into account (but who does that?).
     *
     * @see Axn\ToolKit\Enums\AppEnv
     */
    function app_env_enum(): AppEnv
    {
        static $appEnvEnum = null;

        if ($appEnvEnum === null) {
            $appEnvEnum = AppEnv::from(app()->environment());
        }

        return $appEnvEnum;
    }
}

if (! function_exists('app_env_name')) {
    /**
     * Returns a standardized name of the application environment
     * based on the "app.env" configuration variable.
     *
     * Note that the return value is static, it always returns the first value in the same request.
     * If the environment is modified at runtime, this will not be taken into account (but who does that?).
     *
     * @see Axn\ToolKit\Enums\AppEnv
     */
    function app_env_name(): string
    {
        static $appEnvName = null;

        if ($appEnvName === null) {
            $appEnvName = AppEnv::name(app_env_enum());
        }

        return $appEnvName;
    }
}

if (! function_exists('carbon')) {
    /**
     * Create a Carbon instance from a date string, a DateTime instance or a timestamp.
     */
    function carbon(
        DateTime|int|string|null $date = null,
        ?string $fromFormat = null,
        DateTimeZone|string|null $tz = null
    ): Carbon {
        if (empty($date)) {
            return Carbon::now($tz);
        }

        if ($date instanceof DateTime) {
            $carbon = Carbon::instance($date);

            if (! is_null($tz)) {
                $carbon->setTimezone($tz);
            }

            return $carbon;
        }

        if (is_int($date) || ctype_digit($date)) {
            return Carbon::createFromTimestamp($date, $tz);
        }

        if (! in_array($fromFormat, [null, '', '0'], true)) {
            return Carbon::createFromFormat($fromFormat, $date, $tz);
        }

        return Carbon::parse($date, $tz);
    }
}

if (! function_exists('collect_models')) {
    /**
     * Create an Eloquent collection of Eloquent models.
     *
     * @param  array<EloquentModel>  $models
     *
     * @throws InvalidArgumentException
     */
    function collect_models(array $models): EloquentCollection
    {
        if (! array_all($models, fn ($model): bool => $model instanceof EloquentModel)) {
            throw new InvalidArgumentException('The collect_models helper expects an array of Eloquent Model');
        }

        return new EloquentCollection($models);
    }
}

if (! function_exists('str_html')) {
    /**
     * Create an HtmlString instance.
     */
    function str_html(string $str): HtmlString
    {
        return new HtmlString($str);
    }
}

if (! function_exists('linebreaks')) {
    /**
     * Convert all line-endings to UNIX format,
     * ie. replace "\r\n" and "\r" by "\n".
     */
    function linebreaks(string $str): string
    {
        return str_replace(["\r\n", "\r"], ["\n", "\n"], $str);
    }
}

if (! function_exists('nl_to_p')) {
    /**
     * Convert new lines into HTML paragraphs.
     */
    function nl_to_p(string $str): string
    {
        // Convert all line-endings to UNIX format
        $str = linebreaks($str);

        // Don't allow out-of-control blank lines
        $str = preg_replace("/\n{2,}/", "\n\n", $str);

        // Replace multiple linebreaks by paragraphs
        $str = preg_replace('/\n(\s*\n)+/', '</p><p>', (string) $str);

        // Replace the single linebreaks by <br> elements
        $str = nl2br((string) $str, false);

        return '<p>'.$str.'</p>';
    }
}

if (! function_exists('nl_to_p_flat')) {
    /**
     * Convert text to a single HTML paragraph,
     * replacing all consecutive newlines with a single <br>.
     */
    function nl_to_p_flat(string $str): string
    {
        // Convert all line-endings to UNIX format
        $str = linebreaks($str);

        // Replace all consecutive newlines (with optional whitespace) with a single <br>
        $str = preg_replace('/\n(\s*\n)*/', '<br>', $str);

        return '<p>'.$str.'</p>';
    }
}

if (! function_exists('nl_to_br')) {
    /**
     * Alias of native PHP function nl2br()
     */
    function nl_to_br(string $str, bool $useXhtml = false): string
    {
        return nl2br($str, $useXhtml);
    }
}

if (! function_exists('number_formatted')) {
    /**
     * Returns a number in current language format.
     */
    function number_formatted(float|string $value, int $decimals = 0, bool $trimZeroDecimals = false): string
    {
        $floatValue = (float) $value;

        // If requested and no actual decimals, don't display any
        $decimalsToUse = ($trimZeroDecimals && floor($floatValue) === $floatValue) ? 0 : $decimals;

        return number_format($floatValue, $decimalsToUse,
            trans('number.decimals_separator'),
            trans('number.thousands_separator')
        );
    }
}

if (! function_exists('compute_dec_to_time')) {
    /**
     * Decimal to time calculation.
     *
     * 1.75 => ['hours' => 1, 'minutes' => 45, 'seconds' => 0]
     *
     * @return array{hours: float, minutes: float, seconds: int}
     */
    function compute_dec_to_time(float|string $dec): array
    {
        // prevent french notation
        if (is_string($dec)) {
            $dec = (float) str_replace(',', '.', $dec);
        }

        // start by converting to seconds
        $seconds = ($dec * 3600);

        // we're given hours, so let's get those the easy way
        $hours = floor($dec);

        // since we've "calculated" hours, let's remove them from the seconds variable
        $seconds -= $hours * 3600;

        // calculate minutes left
        $minutes = floor($seconds / 60);

        // finaly, get the rest of seconds
        $seconds %= 60;

        return ['hours' => $hours, 'minutes' => $minutes, 'seconds' => $seconds];
    }
}

if (! function_exists('convert_dec_to_time')) {
    /**
     * Decimal to time conversion.
     *
     * convert_dec_to_time(1.75) => '01:45:00'
     * convert_dec_to_time(1.75, '%2$s:%3$s') => '45:00'
     */
    function convert_dec_to_time(float|string $dec, string $pattern = '%s:%s:%s'): string
    {
        $time = compute_dec_to_time($dec);

        $pad = fn ($value): string => str_pad((string) $value, 2, '0', STR_PAD_LEFT);

        return sprintf(
            $pattern,
            $pad($time['hours']),
            $pad($time['minutes']),
            $pad($time['seconds'])
        );
    }
}

if (! function_exists('human_readable_bytes_size')) {
    /**
     * Convert a byte size into a human-readable localized size.
     */
    function human_readable_bytes_size(int $bytes, int $decimals = 0, bool $trimZeroDecimals = false): string
    {
        $units = [
            trans('unit.B'),
            trans('unit.kB'),
            trans('unit.MB'),
            trans('unit.GB'),
            trans('unit.TB'),
        ];

        $bytes = max($bytes, 0);
        $pow = floor(($bytes !== 0 ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        $bytes /= (1 << (10 * $pow));

        return number_formatted($bytes, $decimals, $trimZeroDecimals).' '.$units[$pow];
    }
}

if (! function_exists('mime_type_to_fa5_class')) {
    /**
     * Get the FontAwesome 5 icon class for a given MIME type.
     */
    function mime_type_to_fa5_class(string $inputMimeType, string $default = 'fa-file'): string
    {
        return MimeTypeToFontAwesomeIcon::toFa5Class($inputMimeType, $default);
    }
}

if (! function_exists('mime_type_to_fa6_class')) {
    /**
     * Get the FontAwesome 6 icon class for a given MIME type.
     */
    function mime_type_to_fa6_class(string $inputMimeType, string $default = 'fa-file'): string
    {
        return MimeTypeToFontAwesomeIcon::toFa6Class($inputMimeType, $default);
    }
}

if (! function_exists('mime_type_to_fa7_class')) {
    /**
     * Get the FontAwesome 7 icon class for a given MIME type.
     */
    function mime_type_to_fa7_class(string $inputMimeType, string $default = 'fa-file'): string
    {
        return MimeTypeToFontAwesomeIcon::toFa7Class($inputMimeType, $default);
    }
}

if (! function_exists('trans_ucfirst')) {
    /**
     * Translate the given message with first character uppercase.
     *
     * @param  array<string, string>  $replace
     */
    function trans_ucfirst(string $key, array $replace = [], ?string $locale = null): string|array|null
    {
        $translation = app('translator')->get($key, $replace, $locale);

        if (is_string($translation)) {
            return mb_ucfirst($translation);
        }

        return $translation;
    }
}

if (! function_exists('is_valid_model')) {
    /**
     * Indicates whether the model class is instantiable
     * and is an instance of Illuminate\Database\Eloquent\Model.
     */
    function is_valid_model(string $modelClass): bool
    {
        try {
            $rc = new ReflectionClass($modelClass);

            return $rc->isInstantiable() && $rc->isSubclassOf(EloquentModel::class);
        } catch (ReflectionException) {
            return false;
        }
    }
}

if (! function_exists('semver_to_id')) {
    /**
     * Transforms a semver version number into a numeric identifier.
     *
     * Please note: does not take into account "pre-releases" (RC, beta, etc.)
     *
     * @throws UnexpectedValueException
     */
    function semver_to_id(string $version): int
    {
        return VersionNumber::toId($version);
    }
}
