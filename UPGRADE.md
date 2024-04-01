UPGRADE
=======

From 9.x to 10.x
----------------

This package now requires at least **PHP 8.2** and **Laravel 10**.
To install this new version you must update your application accordingly.

From 8.x to 9.x
---------------

### Renammed package from `axn/laravel-extension` to `axn/tool-kit-for-laravel`

As the package has been renamed, even if the old name will continue to work, it is better to update the `composer.json` file by replacing `axn/laravel-extension` in it with `axn/tool-kit-for-laravel`.

### Replaced `axn/laravel-common-languages-terms` by `forxer/generic-term-translations-for-laravel`

Use the locales publisher of [Laravel Lang](https://laravel-lang.com/) to add/update/reset or remove translations:

- If you have never used [Laravel Lang](https://laravel-lang.com/): [add locales](https://laravel-lang.com/usage/add-locales.html)
- If you are already using [Laravel Lang](https://laravel-lang.com/): just [update the locales](https://laravel-lang.com/usage/update-locales.html)

### Removed use of deprecated `laravelcollective/html` package

As the `laravelcollective/html` package has been deprecated we decided to remove the HTML and FORM macros that used it.

#### Html macros

You can replace the `Html::requiredMarker()` Html macro by the component:

```blade
<x-required-field-marker />
```

You can also replace the `Html::infoRequiredFields()` Html macro simply with:

```blade
{!! trans('misc.info_required_fields') !!} <x-required-field-marker />
```

Regarding the `labelRequired` Form macro we decided not to replace it because it does not belong here. There are plenty of ways to implement forms (in this case label tags). But the two previous components are there to help you.

However if you still use `laravelcollective/html` in your application, by defining a new form macro "labelRequired" in a service provider, for example in a ViewServiceProvider class:

```php
<?php

namespace App\Providers;

use Collective\Html\FormFacade;
use Illuminate\Support\HtmlString;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Form macro to replace "axn/laravel-extension" 8.x with "axn/tool-kit-for-laravel" 9.x;
        // and more specifically labelRequired form macro
        FormFacade::macro('labelRequired', function ($name, $value = null, $options = [], $escapeHtml = true): HtmlString {
            if ($escapeHtml) {
                $value = e($value);
            }

            $value .= '&nbsp;<span class="required-field-marker">&#x2a;<span>'.trans('misc.required_field').'</span></span>';

            return FormFacade::label($name, $value, $options, false);
        });
    }
}
```

#### CSS class

The previous marker had the CSS class ".required" this one is now by default ".required-field-marker" ; There is no longer a class to hide the text. You can style it for example like this:

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

From 7.x to 8.x
---------------

This package now requires at least **PHP 8** and **Laravel 8**. To install this new version you must update your application accordingly.

We removed deprecated Blade directives: `hassection`, `endhassection`, `doesnthavesection` and `enddoesnthavesection` in favor of native Laravel Blade helpers.

- Find `@hassection`
- Replace by `@hasSection`

- Find `@endhassection`
- Replace by `@endif`

- Find `@doesnthavesection`
- Replace by `@sectionMissing`

- Find `@enddoesnthavesection`
- Replace by `@endif`


From 6.x to 7.x
---------------

This package now requires at least **Laravel 6**. To install this new version you must update your application accordingly.

