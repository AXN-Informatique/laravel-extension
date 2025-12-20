Enums
=====

- [AppEnv](#environment-application)
- [Civilities](#civilities)


## Environment Application

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
use Axn\ToolKit\Enums\AppEnv;

AppEnv::prodNames(); // ['prod', 'production']
AppEnv::preprodNames(); // ['preprod', 'pre-prod', 'preproduction', 'pre-production']
AppEnv::testNames(); // ['test', 'tests', 'testing', 'stage', 'staging']
AppEnv::localNames(); // ['local', 'develop', 'dev']

```

## Civilities

An enumeration to handle civilities/titles in forms.

```php
use Axn\ToolKit\Enums\Civilities;

Civilities::None;  // 0
Civilities::Mrs;   // 1
Civilities::Mr;    // 2
```

Get the translated title or abbreviation:

```php
$civility = Civilities::Mrs;

$civility->title();  // trans('civilities.mrs')
$civility->abbr();   // trans('civilities.mrs_abbr')
```

Get all titles or abbreviations indexed by value:

```php
Civilities::titles();
// [0 => '', 1 => 'Madame', 2 => 'Monsieur']

Civilities::abbreviations();
// [0 => '', 1 => 'Mme', 2 => 'M.']
```
