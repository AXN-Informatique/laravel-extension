Tool Kit for Laravel  (formerly "Laravel extension")
====================================================

Includes a set of useful tools for the Laravel framework.

- [Installation](#installation)
- [Helpers](#helpers)
    - [app_env_enum()](#app_env_enum)
    - [app_env_name()](#app_env_name)
    - [carbon()](#carbon)
    - [collect_models()](#collect_models)
    - [str_html()](#str_html)
    - [linebreaks()](#linebreaks)
    - [nl_to_p()](#nl_to_p)
    - [nl_to_br()](#nl_to_br)
    - [number_formatted()](#number_formatted)
    - [compute_dec_to_time()](#compute_dec_to_time)
    - [convert_dec_to_time()](#convert_dec_to_time)
    - [human_readable_bytes_size()](#human_readable_bytes_size)
    - [trans_ucfirst()](#trans_ucfirst)
    - [is_valid_model()](#is_valid_model)
    - [semver_to_id()](#semver_to_id)
- [Blade directives](#blade-directives)
    - [@nltop()](#nltop)
    - [@nltobr()](#nltobr)
- [Components](#components)
    - [Add an indicator for a required field](#add-an-indicator-for-a-required-field)
- [Enums](#enums)
    - [Environment application](#environment-application)
    - [Civilities](#civilities)


Installation
------------

With Composer :

```sh
composer require axn/tool-kit-for-laravel
```

To use some of these tools you must have correctly installed the package [forxer/generic-term-translations-for-laravel](https://github.com/forxer/generic-term-translations-for-laravel#generic-term-translations-for-laravel) already prerequisite by this package (therefore present).

Use the locales publisher of [Laravel Lang](https://laravel-lang.com/) to add/update/reset or remove translations:

- If you have never used [Laravel Lang](https://laravel-lang.com/): [add locales](https://laravel-lang.com/usage/add-locales.html)
- If you are already using [Laravel Lang](https://laravel-lang.com/): just [update the locales](https://laravel-lang.com/usage/update-locales.html)


Helpers
-------

### app_env_enum()

Returns a standardized enumeration of the application environment based on the "app.env" configuration variable. This helper uses the `AppEnv` enumeration.

```php
return app_env_enum();
// enum AppEnv
```

Note that the return value is static, it always returns the first value in the same request. If the environment is modified at runtime, this will not be taken into account (but who does that?).

For more details please see the chapter on [AppEnv enumeration](#environment-application).

### app_env_name()

Returns a standardized name of the application environment based on the "app.env" configuration variable. This helper uses the `AppEnv` enumeration.

```php
echo app_env_name();
// 'prod', 'preprod', 'test', 'local' or 'unknown'
```

Note that the return value is static, it always returns the first value in the same request. If the environment is modified at runtime, this will not be taken into account (but who does that?).

For more details please see the chapter on [AppEnv enumeration](#environment-application).

### carbon()

Create a Carbon instance from a date string, a DateTime instance or a timestamp.

```php
    /**
     * Create a Carbon instance from a date string, a DateTime instance or a timestamp.
     *
     * @param  \DateTime|int|string|null $date
     * @param  string|null $fromFormat
     * @param  \DateTimeZone|string|null $tz
     * @return \Illuminate\Support\Carbon
     * */
    function carbon($date = null, $fromFormat = null, $tz = null)
```

Here are some examples.

Using Carbon:

```php
use Axn\ToolKit\Enums\AppEnv;

$date = Carbon::now();
$date = Carbon::now('Europe/Paris');
$date = Carbon::createFromFormat('Y-m-d H:i', '2018-06-18 09:30');
$date = Carbon::createFromFormat('Y-m-d H:i', '2018-06-18 09:30', 'Europe/Paris');
$date = new Carbon('Thursday, June 18 2015 9:30:00');
$date = new Carbon('Thursday, June 18 2015 9:30:00', 'Europe/Paris');
$date = Carbon::createFromTimestamp(1434619800)
```

Equivalents using helper:

```php
$date = carbon();
$date = carbon(tz: 'Europe/Paris');
$date = carbon('2018-06-18 09:30', 'Y-m-d H:i');
$date = carbon('2018-06-18 09:30', 'Y-m-d H:i', 'Europe/Paris');
$date = carbon('Thursday, June 18 2015 9:30:00');
$date = carbon('Thursday, June 18 2015 9:30:00', tz: 'Europe/Paris');
$date = carbon(1434619800)
$date = carbon(1434619800, tz: 'Europe/Paris')
```

### collect_models()

Create a collection of Eloquent models.

```php
    /**
     * Create an Eloquent collection of Eloquent models.
     *
     * @param  array $models
     * @return EloquentCollection
     */
    function collect_models(array $models)
```

### str_html()

Create an `Illuminate\Support\HtmlString` instance.

```php
$str = '<a>An HTML string</p>';

$htmlString = str_html($str);

// Alias of

$htmlString = new Illuminate\Support\HtmlStringHtmlString($str);
```

### linebreaks()

Convert all line-endings to UNIX format.

Replace `"\r\n"` and `"\r"` by `"\n"`

### nl_to_p()

Convert new lines into HTML paragraphs `<p>`.

```php
$str = "a text with \n new lines \n\n again \n\n\n and again";

nl_to_p($str);
// <p>a text with <br> new lines </p><p> again </p><p> and again</p>
```
### nl_to_br()

Alias of native PHP function `nl2br()`.

```php
$str = "a text with \n new lines \n\n again \n\n\n and again";

nl_to_br($str)
// a text with <br> new lines <br><br> again <br><br><br> and again
```

### number_formatted()

Returns a number in current application language format.

```php
$number = '123456789.101112';

$numberFormated = number_formated($number, 2);

// fr: 123 456 789,10
// en: 123,456,789.10
```

### compute_dec_to_time()

Decimal to time calculation, return an array with hours, minutes and seconds.

```php
$number = '1.75';

$time = compute_dec_to_time($number);

// [
//    'hours' => 1.0,
//    'minutes' => 45.0,
//    'seconds' => 0,
// ]
```

### convert_dec_to_time()

Decimal to time conversion. Output can be changed with `sprintf` format.

```php
$number = '1.75';

$time = convert_dec_to_time($number);
// 01:45:00

$time = convert_dec_to_time($number, '%sh%s');
// 01h45

$time = convert_dec_to_time($number, '%2$s:%3$s');
// 45:00
```

### human_readable_bytes_size()

Convert a bytes size into a human readable localized size.

```php
$size = human_readable_bytes_size(2048);
// fr: 2 ko
// en: 2 kB

$size = human_readable_bytes_size(2048*1024);
// fr: 2 Mo
// en: 2 MB

$size = human_readable_bytes_size(2048*1024*10000, 2);
// fr: 19,53 Go
// en: 19.53 GB
```

### mime_type_to_fa5_class()

Return a fontawesome 5 file icon class for specific MIME Type.

### mime_type_to_fa6_class()

Return a fontawesome 6 file icon class for specific MIME Type.

### mime_type_to_fa7_class()

Return a fontawesome 7 file icon class for specific MIME Type.

### trans_ucfirst()

Translate the given message with first character uppercase.

### is_valid_model()

Indicates whether the model class is instantiable and is an instance of `Illuminate\Database\Eloquent\Model`.

### semver_to_id()

Transforms a semver version number into a numeric identifier. Please note: does not take into account "pre-releases" (RC, beta, etc.)

```php
$phpVersion = "8.2.14";
$phpVersionId = semver_to_id($phpVersion);
// 80214

$laravelVersion = " 10.38.2";
$laravelVersionId = semver_to_id($laravelVersion);
// 103802
```

This is useful for optimizing comparisons, searches and sorting in a database on numeric rather than text columns.


Blade directives
----------------

 ### @nltop()

Convert new lines into HTML paragraphs `<p>`.

```blade
@nltop ("a text with \n new lines \n\n again \n\n\n and again")
```

Displays:

```html
<p>a text with <br> new lines </p><p> again </p><p> and again</p>
```

### @nltobr()

Convert new lines into HTML `<br>`

```blade
@nltobr ("a text with \n new lines \n\n again \n\n\n and again")
```

Displays:

```html
a text with <br> new lines <br><br> again <br><br><br> and again
```

Components
----------

### Add an indicator for a required field

To display a required field marker (e.g. in a label tag):

```blade
<x-required-field-marker />
```

Displays:

```html
<span class="required-field-marker">
   &#x2a;<span>required</span>
</span>
```

You can change the default symbol "&#x2a;" (an asterisk) by the marker symbol of your choice:

```blade
<x-required-field-marker :symbol="⚠" />
```

You can style it for example like this:

```css
.required-field-marker {
    color: #da1313;
}
.required-field-marker > span {
   /* Bootstrap styles of .visually-hidden class */
   position: absolute !important;
   width: 1px !important;
   height: 1px !important;
   padding: 0 !important;
   margin: -1px !important;
   overflow: hidden !important;
   clip: rect(0, 0, 0, 0) !important;
   white-space: nowrap !important;
   border: 0 !important;
}
```

In your forms you can indicate the required fields for example in this way:

```blade
{!! trans('misc.info_required_fields'); !!} <x-required-field-marker />
```

Enums
-----

### Environment application

This package provides a utility enum `AppEnv`. This allows to standardize environment names.

Indeed, for example, some projects uniformly have the environment "prod" and "production"; or even "preprod" and "pre-production", worse: "pre-prod".


```php
use Axn\ToolKit\Enums\AppEnv;

AppEnv::prod;
AppEnv::preprod;
AppEnv::test;
AppEnv::local;
AppEnv::unknown;
```

Creating an instance of the enumeration from a character string:

```php
use Axn\ToolKit\Enums\AppEnv;

$appEnv = AppEnv::from('pre-prod'); // AppEnv::preprod

$appEnv = AppEnv::from(app()->environment()); // enum AppEnv
```

Find the standardized name from a string:

```php
use Axn\ToolKit\Enums\AppEnv;

$appEnv = AppEnv::name('pre-prod'); // 'preprod'

$appEnv = AppEnv::name(app()->environment()); // one of enum cases ('prod', 'preprod', 'test', 'local' or 'unknown')
```

Testing the environment type:

```php
use Axn\ToolKit\Enums\AppEnv;

AppEnv::isProd('pre-prod'); // false
AppEnv::isPreprod('pre-prod'); // true
AppEnv::isTest('pre-prod'); // false
AppEnv::isLocal('pre-prod'); // false

if (AppEnv::isProd(app()->environment())) {
    // do something in "prod"
}
```

Reverse methods are available:

```php
use Axn\ToolKit\Enums\AppEnv;

AppEnv::isNotProd('pre-prod'); // true
AppEnv::isNotPreprod('pre-prod'); // false
AppEnv::isNotTest('pre-prod'); // true
AppEnv::isNotLocal('pre-prod'); // true
```

Retrieving environment values ​​defined in the enum:

```php
use Axn\ToolKit\Enums\Civilities;

AppEnv::prodNames(); // ['prod', 'production']
AppEnv::preprodNames(); // ['preprod', 'pre-prod', 'preproduction', 'pre-production']
AppEnv::testNames(); // ['test', 'tests', 'testing', 'stage', 'staging']
AppEnv::localNames(); // ['local', 'develop', 'dev']

```

### Civilities

An enumeration to handle civilities is available with `Axn\ToolKit\Enums\Civilities`


```php
// @todo: need to document this
```

@todo: need to document this
