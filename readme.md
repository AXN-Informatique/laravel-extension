## Laravel Extension

Ce package regroupe toutes les extensions faites du framework Laravel 5.

## Installation

Inclure le package avec Composer :

```
composer require axn/laravel-extension
```

## Utilisation de l'extension d'Eloquent

Ajouter le service provider au tableau des providers dans config/app.php :

```
'Axn\Illuminate\Database\DatabaseServiceProvider',
```

Ajouter le trait Axn\Illuminate\Database\Eloquent\Model aux modèles pour lesquels
l'extension d'Eloquent est souhaitée :

```php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Axn\Illuminate\Database\Eloquent\Model as EloquentExtension;

class User extends Model
{
    use EloquentExtension;

    // ...
}
```

Cette extension offre la possibilité de faire des jointures en utilisant les relations
definies dans le modèle. Seules les relations BelongsTo, HasOneOrMany et MorphOneOrMany
sont gérées. Ainsi, pour joindre une table en relation BelongsToMany, il faut d'abord
passé par la table pivot. Exemple :

```php
User::joinRel('userRoles')
    ->joinRel('userRoles.role')
    ->get();

// Ou bien, en utilisant des alias :
User::alias('u')
    ->joinRel('userRoles', 'ur')
    ->joinRel('ur.role', 'r')
    ->get();
```

Des alias à joinRel() sont également disponibles pour faire des LEFT JOIN ou pour inclure
les enregistrements "soft deleted" :
 - joinRelWithTrashed()
 - leftJoinRel()
 - leftJoinRelWithTrashed()

## Autre...

**Foundation/Testing/NestedViewsAssertions.php :**

En complément du trait Illuminate\Foundation\Testing\AssertionsTrait pour faire des
assertions sur les vues imbriquées.

**helpers.php :**

En complément des helpers de Laravel.
