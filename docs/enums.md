---
title: Énumérations
order: 4
---

Enums
=====

- [AppEnv](#appenv)
- [BytesConvention](#bytesconvention)
- [Civilities](#civilities)


## AppEnv

Standardize environment names across projects. Handles variations like "prod"/"production", "pre-prod"/"preproduction", etc.

```php
use Axn\ToolKit\Enums\AppEnv;

// Available cases
AppEnv::prod;
AppEnv::preprod;
AppEnv::test;
AppEnv::local;
AppEnv::unknown;

// Create from string
AppEnv::from('pre-prod');              // AppEnv::preprod
AppEnv::from(app()->environment());    // current env as enum

// Get standardized name
AppEnv::name('pre-prod');              // 'preprod'
AppEnv::name(app()->environment());    // 'prod', 'preprod', 'test', 'local' or 'unknown'

// Test environment type
AppEnv::isProd('production');          // true
AppEnv::isPreprod('pre-prod');         // true
AppEnv::isTest('staging');             // true
AppEnv::isLocal('dev');                // true

// Negation methods
AppEnv::isNotProd('pre-prod');         // true
AppEnv::isNotPreprod('prod');          // true
AppEnv::isNotTest('prod');             // true
AppEnv::isNotLocal('prod');            // true

// Get recognized names for each type
AppEnv::prodNames();     // ['prod', 'production']
AppEnv::preprodNames();  // ['preprod', 'pre-prod', 'preproduction', 'pre-production']
AppEnv::testNames();     // ['test', 'tests', 'testing', 'stage', 'staging']
AppEnv::localNames();    // ['local', 'develop', 'dev']

// Convert enum or string to lowercase ASCII name
AppEnv::nameStringFromValue(AppEnv::preprod);  // 'preprod'
AppEnv::nameStringFromValue('Pre-Production'); // 'pre-production'
```

Usage example:

```php
if (AppEnv::isProd(app()->environment())) {
    // production-specific code
}
```


## BytesConvention

Selects the convention used to convert byte sizes into human-readable strings, used by the [`human_readable_bytes_size()`](helpers.md#human_readable_bytes_size) family of helpers.

Two conventions are available:
- `si` — decimal SI (base `1000`, labels `kB`, `MB`, `GB`, `TB`). Used by storage vendors, hosting providers, and matches end-user expectations.
- `iec` — binary IEC (base `1024`, labels `KiB`, `MiB`, `GiB`, `TiB`). Used by most operating systems for binary-based sizes.

```php
use Axn\ToolKit\Enums\BytesConvention;

// Available cases
BytesConvention::si;
BytesConvention::iec;

// Get the divisor base
BytesConvention::si->base();   // 1000
BytesConvention::iec->base();  // 1024

// Get the ordered list of unit translation keys
BytesConvention::si->unitKeys();
// ['unit.B', 'unit.kB', 'unit.MB', 'unit.GB', 'unit.TB']

BytesConvention::iec->unitKeys();
// ['unit.B', 'unit.KiB', 'unit.MiB', 'unit.GiB', 'unit.TiB']
```

Typical usage is via the dedicated helpers rather than the enum directly:

```php
human_readable_bytes_size_si(15_000_000_000);   // "15 Go" (fr) / "15 GB" (en)
human_readable_bytes_size_iec(15_000_000_000, 2); // "13,97 Gio" (fr) / "13.97 GiB" (en)
```


## Civilities

Handle civilities/titles in forms.

```php
use Axn\ToolKit\Enums\Civilities;

// Available cases
Civilities::None;  // 0
Civilities::Mrs;   // 1
Civilities::Mr;    // 2

// Get translated title or abbreviation
$civility = Civilities::Mrs;
$civility->title();  // trans('civilities.mrs')
$civility->abbr();   // trans('civilities.mrs_abbr')

// Get all titles/abbreviations indexed by value
Civilities::titles();
// [0 => '', 1 => 'Madame', 2 => 'Monsieur']

Civilities::abbreviations();
// [0 => '', 1 => 'Mme', 2 => 'M.']
```
