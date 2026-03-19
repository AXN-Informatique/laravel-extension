---
title: Tool Kit for Laravel
order: 0
---

Tool Kit for Laravel
====================

A utility package providing helpers, Blade directives, components, and enums for Laravel applications.

Requirements: **PHP 8.4+** and **Laravel 12.x or 13.x**.


Documentation
-------------

- [Helpers](helpers.md) — Global helper functions
- [Blade Directives](blade-directives.md) — @nltobr, @nltobrcompact, @nltop, @nltopflat
- [Components](components.md) — Required field marker
- [Enums](enums.md) — AppEnv, Civilities


Installation
------------

```bash
composer require axn/tool-kit-for-laravel
```

To use some of these tools you must have correctly installed the package [forxer/generic-term-translations-for-laravel](https://github.com/forxer/generic-term-translations-for-laravel#generic-term-translations-for-laravel) already prerequisite by this package (therefore present).

Use the locales publisher of [Laravel Lang](https://laravel-lang.com/) to add/update/reset or remove translations:

- If you have never used [Laravel Lang](https://laravel-lang.com/): [add locales](https://laravel-lang.com/usage/add-locales.html)
- If you are already using [Laravel Lang](https://laravel-lang.com/): just [update the locales](https://laravel-lang.com/usage/update-locales.html)
