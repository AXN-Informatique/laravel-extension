Enums
=====

- [AppEnv](#appenv)
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

// Get recognized names for each type
AppEnv::prodNames();     // ['prod', 'production']
AppEnv::preprodNames();  // ['preprod', 'pre-prod', 'preproduction', 'pre-production']
AppEnv::testNames();     // ['test', 'tests', 'testing', 'stage', 'staging']
AppEnv::localNames();    // ['local', 'develop', 'dev']
```

Usage example:

```php
if (AppEnv::isProd(app()->environment())) {
    // production-specific code
}
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
