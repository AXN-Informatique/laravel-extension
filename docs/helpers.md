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

See also: [AppEnv enumeration](enums.md#environment-application)

## app_env_name()

Returns the standardized environment name as a string.

```php
app_env_name(); // 'prod', 'preprod', 'test', 'local' or 'unknown'
```

## carbon()

Create a Carbon instance from various date formats.

```php
carbon();                                              // now
carbon(tz: 'Europe/Paris');                            // now with timezone
carbon('2018-06-18 09:30', 'Y-m-d H:i');              // from format
carbon('Thursday, June 18 2015 9:30:00');             // parsed string
carbon(1434619800);                                    // from timestamp
carbon(1434619800, tz: 'Europe/Paris');               // timestamp with timezone
```

## collect_models()

Create an Eloquent collection from an array of models. Throws `InvalidArgumentException` if any element is not an Eloquent Model.

```php
$collection = collect_models([$user, $admin]);
```

## str_html()

Create an `HtmlString` instance (shortcut for `new HtmlString($str)`).

```php
$html = str_html('<strong>Bold</strong>');
```

## linebreaks()

Normalize line endings to UNIX format (replace `\r\n` and `\r` with `\n`).

## nl_to_p()

Convert newlines to HTML paragraphs. Multiple consecutive newlines create new paragraphs, single newlines become `<br>`.

```php
nl_to_p("First paragraph\n\nSecond paragraph");
// <p>First paragraph</p><p>Second paragraph</p>
```

## nl_to_p_flat()

Convert text to a single paragraph, all consecutive newlines become a single `<br>`.

```php
nl_to_p_flat("Line 1\n\nLine 2\n\n\nLine 3");
// <p>Line 1<br>Line 2<br>Line 3</p>
```

## nl_to_br()

Alias of PHP's `nl2br()`.

## number_formatted()

Format a number according to the current application locale.

```php
number_formatted(123456.789, 2);           // fr: "123 456,79" / en: "123,456.79"
number_formatted(42.00, 2, true);          // "42" (trimZeroDecimals)
number_formatted(42.50, 2, true);          // fr: "42,50" / en: "42.50"
```

## compute_dec_to_time()

Convert decimal hours to an array with hours, minutes, and seconds.

```php
compute_dec_to_time(1.75);
// ['hours' => 1, 'minutes' => 45, 'seconds' => 0]
```

## convert_dec_to_time()

Convert decimal hours to a formatted time string.

```php
convert_dec_to_time(1.75);               // "01:45:00"
convert_dec_to_time(1.75, '%sh%s');      // "01h45"
convert_dec_to_time(1.75, '%2$s:%3$s');  // "45:00"
```

## human_readable_bytes_size()

Convert bytes to a human-readable localized string.

```php
human_readable_bytes_size(2048);           // fr: "2 ko" / en: "2 kB"
human_readable_bytes_size(2048*1024);      // fr: "2 Mo" / en: "2 MB"
human_readable_bytes_size(1024, 2, true);  // fr: "1 ko" / en: "1 kB" (trimZeroDecimals)
```

## mime_type_to_fa5_class()

Get FontAwesome 5 icon class for a MIME type.

```php
mime_type_to_fa5_class('application/pdf');  // "fa-file-pdf"
mime_type_to_fa5_class('image/jpeg');       // "fa-file-image"
mime_type_to_fa5_class('application/zip');  // "fa-file-archive"
```

## mime_type_to_fa6_class()

Get FontAwesome 6 icon class for a MIME type.

```php
mime_type_to_fa6_class('application/pdf');  // "fa-file-pdf"
mime_type_to_fa6_class('application/zip');  // "fa-file-zipper"
```

## mime_type_to_fa7_class()

Get FontAwesome 7 icon class for a MIME type. Provides format-specific icons.

```php
mime_type_to_fa7_class('image/png');                  // "fa-file-png"
mime_type_to_fa7_class('audio/mp3');                  // "fa-file-mp3"
mime_type_to_fa7_class('application/vnd.ms-excel');   // "fa-file-xls"
```

## trans_ucfirst()

Translate a message with the first character uppercased.

```php
trans_ucfirst('validation.required'); // "The field is required" (with uppercase first letter)
```

## is_valid_model()

Check if a class is an instantiable Eloquent model.

```php
is_valid_model(User::class);      // true
is_valid_model(SomeClass::class); // false
```

## semver_to_id()

Convert a semver version to a numeric identifier (useful for database indexing).

```php
semver_to_id('8.2.14');   // 80214
semver_to_id('10.38.2');  // 103802
```

Note: Does not support pre-release versions (RC, beta, etc.)
