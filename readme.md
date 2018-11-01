Laravel Extension
=================

Includes a set of extensions to the Laravel Framework 5.4+

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

In Laravel 5.5 the service provider is automaticaly included.
In older versions of the framework, simply add this service provider to the array
of providers in `config/app.php` :

```php
// config/app.php

'provider' => [
    //...
    Axn\Illuminate\ServiceProvider::class,
    //...
];
```

Helpers
-------

In addition to Laravel helpers:

- `carbon()`: Create a Carbon instance from a date string, a DateTime instance or a timestamp.
- `collect_models()`: Create a collection of Eloquent models.
- `str_html()`: Create an Illuminate\Support\HtmlString instance.
- `linebreaks()`: Convert all line-endings to UNIX format.
- `nl_to_p()`: Convert new lines into paragraphs.
- `number_formated()`: Returns a number in current language format.
- `number_fr()`: Returns a number in french format.
- `compute_dec_to_time()`: Decimal to time calculation (returns an array with hours, minutes and seconds).
- `convert_dec_to_time()`: Decimal to time conversion (format: HH:MM:SS).
- `human_readable_bytes_size()`: Convert a bytes size into a human readable size.

Blade directives
----------------

In addition to Laravel Blade directives:

- `@hassection('section-name')`: Indicates if a section exists
- `@doesnthavesection('section-name')`: Indicates if a section does not exist
- `@nltop()`: Transform new lines into paragraphs
- `@nltobr()`: Transform new lines into <br>

```blade
@hassection('section-a')
   // section "section-a" exists...
@endhassection

@doesnthavesection('section-b')
   // section "section-b" does not exist...
@enddoesnthavesection


@nltop("a text with \n new lines \n\n again \n\n\n and again \n\n\n\n\n voilà")
// <p>a text with <br> new lines </p><p> again </p><p> and again </p><p> voilà</p>

@nltobr("a text with \n new lines \n\n again \n\n\n and again \n\n\n\n\n voilà")
// a text with <br> new lines <br><br> again <br><br><br> and again <br><br><br><br><br> voilà

```

HTML/Form macros
----------------

In addition to LaravelCollective HTML and Form methods:

```blade
{!! Form::labelRequired('name', 'Label value') !!}
//
// Displays:
//
// <label for="name">Label value
//      <span class="required">
//          <i class="fa fa-asterisk"></i>
//          <span class="sr-only">required</span>
//      </span>
// </label>

{!! Html::infoRequiredFields() !!}
//
// Displays:
//
// Fields marked with
// <span class="required">
//      <i class="fa fa-asterisk"></i>
//      <span class="sr-only">required</span>
// </span>
// are mandatory.
```
