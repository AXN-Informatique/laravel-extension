UPGRADE
=======

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

You can replace the `Html::requiredMarker()` Html macro by the component:

```blade
<x-required-field-marker />
```

The previous marker had the CSS class ".required" this one is now by default ".required-field-marker" ; There is no longer a class to hide the text. More information in the README file.

You can also replace the `Html::infoRequiredFields()` Html macro simply with:

```blade
{{ trans('misc.info_required_fields) }} <x-required-field-marker />
```

Regarding the `labelRequired` Form macro we decided not to replace it because it does not belong here. There are plenty of ways to implement forms (in this case label tags). But the two previous components are there to help you.


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

