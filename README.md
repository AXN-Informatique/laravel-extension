Laravel Extension
=================

Includes a set of uselful extensions to the Laravel Framework.

* [Installation](#installation)
* [Helpers](#helpers)
* [Blade directives](#blade-directives)
* [HTML/Form macros](#htmlform-macros)

Installation
------------

With Composer :

```sh
composer require axn/laravel-extension
```

Helpers
-------

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
use Carbon\Carbon;

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

// <p>a text with <br> new lines </p><p> again </p><p> and again</p>
```
### nl_to_br()

Alias of native PHP function `nl2br()`.

```php
$str = "a text with \n new lines \n\n again \n\n\n and again";

// a text with <br> new lines <br><br> again <br><br><br> and again
```

### number_formated()

Returns a number in current language format with translations from [laravel-common-languages-terms](https://github.com/AXN-Informatique/laravel-common-languages-terms) package. Based on the application locale.

```php
$number = '123456789.101112';

$numberFormated = number_formated($number, 2);

// fr: 123 456 789,10
// en: 123,456,789.10
```

### number_fr()

Returns a number in french format.

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
// 1h45

$time = convert_dec_to_time($number, '%2$s:%3$s');
// 45:00
```

### human_readable_bytes_size()

Convert a bytes size into a human readable localized size.

Translations from [laravel-common-languages-terms](https://github.com/AXN-Informatique/laravel-common-languages-terms) package. Based on the application locale.

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

Return a font awesome file icon class for specific MIME Type.

### trans_ucfirst()

Translate the given message with first character uppercase.

### is_valid_model()

Indicates whether the model class is instantiable and is an instance of `Illuminate\Database\Eloquent\Model`.


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

HTML/Form macros
----------------

In addition to LaravelCollective HTML and Form methods:

```blade
{!! Form::labelRequired('name', 'Label value') !!}
```

Displays:

```html
<label for="name">Label value
   <span class="required">
      &#x2a;
      <span class="sr-only visually-hidden">required</span>
   </span>
</label>
```

```blade
{!! Html::infoRequiredFields() !!}
```

Displays:

```html
Fields marked with
<span class="required">
   &#x2a;
   <span class="sr-only visually-hidden">required</span>
</span>
are mandatory.
```

```blade
{!! Html::requiredMarker() !!}
```

Displays:

```html
<span class="required">
   &#x2a;
   <span class="sr-only visually-hidden">required</span>
</span>
```
