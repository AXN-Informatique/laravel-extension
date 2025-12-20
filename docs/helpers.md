Helpers
=======

- [app_env_enum()](#app_env_enum)
- [app_env_name()](#app_env_name)
- [carbon()](#carbon)
- [collect_models()](#collect_models)
- [str_html()](#str_html)
- [linebreaks()](#linebreaks)
- [nl_to_p()](#nl_to_p)
- [nl_to_p_flat()](#nl_to_p_flat)
- [nl_to_br()](#nl_to_br)
- [number_formatted()](#number_formatted)
- [compute_dec_to_time()](#compute_dec_to_time)
- [convert_dec_to_time()](#convert_dec_to_time)
- [human_readable_bytes_size()](#human_readable_bytes_size)
- [mime_type_to_fa5_class()](#mime_type_to_fa5_class)
- [mime_type_to_fa6_class()](#mime_type_to_fa6_class)
- [mime_type_to_fa7_class()](#mime_type_to_fa7_class)
- [trans_ucfirst()](#trans_ucfirst)
- [is_valid_model()](#is_valid_model)
- [semver_to_id()](#semver_to_id)


## app_env_enum()

Returns a standardized `AppEnv` enumeration based on the "app.env" configuration variable.

```php
app_env_enum(); // AppEnv::prod, AppEnv::preprod, AppEnv::test, AppEnv::local or AppEnv::unknown
```

The return value is cached for the duration of the request.

See also: [AppEnv enumeration](enums.md#appenv)


## app_env_name()

Returns the standardized environment name as a string.

```php
app_env_name(); // 'prod', 'preprod', 'test', 'local' or 'unknown'
```

The return value is cached for the duration of the request.


## carbon()

Create a Carbon instance from a date string, a DateTime instance or a timestamp.

```php
carbon();                                              // now
carbon(tz: 'Europe/Paris');                            // now with timezone
carbon('2018-06-18 09:30', 'Y-m-d H:i');              // from format
carbon('2018-06-18 09:30', 'Y-m-d H:i', 'Europe/Paris'); // from format with timezone
carbon('Thursday, June 18 2015 9:30:00');             // parsed string
carbon('Thursday, June 18 2015 9:30:00', tz: 'Europe/Paris'); // parsed string with timezone
carbon(1434619800);                                    // from timestamp
carbon(1434619800, tz: 'Europe/Paris');               // timestamp with timezone
```


## collect_models()

Create an Eloquent collection from an array of models.

```php
$collection = collect_models([$user, $admin]);
```

Throws `InvalidArgumentException` if any element is not an Eloquent Model.


## str_html()

Create an `HtmlString` instance (shortcut for `new HtmlString($str)`).

```php
$html = str_html('<strong>Bold</strong>');
```


## linebreaks()

Normalize line endings to UNIX format (replace `\r\n` and `\r` with `\n`).

```php
linebreaks("Line 1\r\nLine 2\rLine 3");
// "Line 1\nLine 2\nLine 3"
```


## nl_to_p()

Convert newlines to HTML paragraphs. Multiple consecutive newlines create new paragraphs, single newlines become `<br>`.

```php
$str = "a text with \n new lines \n\n again \n\n\n and again";

nl_to_p($str);
// <p>a text with <br> new lines </p><p> again </p><p> and again</p>
```


## nl_to_p_flat()

Convert text to a single paragraph, all consecutive newlines (with optional whitespace) become a single `<br>`.

```php
$str = "a text with \n new lines \n\n again \n\n\n and again";

nl_to_p_flat($str);
// <p>a text with <br> new lines <br> again <br> and again</p>
```


## nl_to_br()

Alias of PHP's `nl2br()`.

```php
$str = "a text with \n new lines \n\n again \n\n\n and again";

nl_to_br($str);
// a text with <br> new lines <br><br> again <br><br><br> and again
```


## number_formatted()

Format a number according to the current application locale.

Parameters:
- `$value` - The number to format
- `$decimals` - Number of decimal places (default: 0)
- `$trimZeroDecimals` - If true, removes trailing zeros (default: false)

```php
$number = '123456789.101112';

number_formatted($number, 2);
// fr: 123 456 789,10
// en: 123,456,789.10

// With trimZeroDecimals parameter to hide trailing zeros
number_formatted(42.00, 2);        // fr: "42,00" / en: "42.00"
number_formatted(42.00, 2, true);  // "42"
number_formatted(42.50, 2, true);  // fr: "42,50" / en: "42.50"
```


## compute_dec_to_time()

Decimal to time calculation, returns an array with hours, minutes and seconds.

```php
$number = '1.75';

compute_dec_to_time($number);
// [
//    'hours' => 1.0,
//    'minutes' => 45.0,
//    'seconds' => 0,
// ]
```


## convert_dec_to_time()

Decimal to time conversion. Output format can be customized with `sprintf` format.

```php
$number = '1.75';

convert_dec_to_time($number);               // "01:45:00"
convert_dec_to_time($number, '%sh%s');      // "01h45"
convert_dec_to_time($number, '%2$s:%3$s');  // "45:00"
```


## human_readable_bytes_size()

Convert bytes to a human-readable localized string.

Parameters:
- `$bytes` - Size in bytes
- `$decimals` - Number of decimal places (default: 0)
- `$trimZeroDecimals` - If true, removes trailing zeros (default: false)

```php
human_readable_bytes_size(2048);
// fr: 2 ko
// en: 2 kB

human_readable_bytes_size(2048*1024);
// fr: 2 Mo
// en: 2 MB

human_readable_bytes_size(2048*1024*10000, 2);
// fr: 19,53 Go
// en: 19.53 GB

// With trimZeroDecimals parameter
human_readable_bytes_size(1024, 2);        // fr: "1,00 ko" / en: "1.00 kB"
human_readable_bytes_size(1024, 2, true);  // fr: "1 ko" / en: "1 kB"
human_readable_bytes_size(1536, 2, true);  // fr: "1,50 ko" / en: "1.50 kB"
```


## mime_type_to_fa5_class()

Get FontAwesome 5 icon class for a MIME type.

The second parameter allows specifying a default icon class if the MIME type is not found.

```php
mime_type_to_fa5_class('application/pdf');  // "fa-file-pdf"
mime_type_to_fa5_class('image/jpeg');       // "fa-file-image"
mime_type_to_fa5_class('application/zip');  // "fa-file-archive"

mime_type_to_fa5_class('unknown/type', 'fa-file-circle-question');
// "fa-file-circle-question" (custom default)
```

Supports common MIME types: images, audio, video, PDF, Microsoft Office documents, archives, code files, etc.


## mime_type_to_fa6_class()

Get FontAwesome 6 icon class for a MIME type.

```php
mime_type_to_fa6_class('application/pdf');  // "fa-file-pdf"
mime_type_to_fa6_class('text/plain');       // "fa-lines"
mime_type_to_fa6_class('application/zip');  // "fa-file-zipper"
```


## mime_type_to_fa7_class()

Get FontAwesome 7 icon class for a MIME type. This version provides more specific icons for file formats.

```php
mime_type_to_fa7_class('image/png');                  // "fa-file-png"
mime_type_to_fa7_class('image/jpeg');                 // "fa-file-jpg"
mime_type_to_fa7_class('audio/mp3');                  // "fa-file-mp3"
mime_type_to_fa7_class('video/mp4');                  // "fa-file-mp4"
mime_type_to_fa7_class('application/vnd.ms-excel');   // "fa-file-xls"
```


## trans_ucfirst()

Translate a message with the first character uppercased.

```php
trans_ucfirst('validation.required');
// "The field is required" (with uppercase first letter)
```


## is_valid_model()

Check if a class is an instantiable Eloquent model.

```php
is_valid_model(User::class);           // true
is_valid_model(AbstractModel::class);  // false (not instantiable)
is_valid_model(SomeClass::class);      // false (not a Model)
```


## semver_to_id()

Convert a semver version to a numeric identifier. Useful for optimizing comparisons, searches and sorting in a database on numeric rather than text columns.

```php
semver_to_id('8.2.14');   // 80214
semver_to_id('10.38.2');  // 103802
```

Note: Does not support pre-release versions (RC, beta, etc.)
