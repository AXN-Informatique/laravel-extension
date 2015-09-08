# Laravel Extension

Ce package regroupe toutes les extensions faites du framework Laravel 5.


## Installation

Inclure le package avec Composer :

```
composer require axn/laravel-extension
```


## Utilisation de l'extension d'Eloquent

Ajouter le service provider au tableau des providers dans `config/app.php` :

```
'Axn\Illuminate\Database\DatabaseServiceProvider',
```

Ajouter le trait `Axn\Illuminate\Database\Eloquent\Model` aux modèles pour lesquels
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


## Utilisation de la commande "optimize:all"

Ajouter la commande à la liste des commandes dans la classe `app/Console/Kernel.php` :

```
'Axn\Illuminate\Foundation\Console\OptimizeAll',
```

Pour lancer la commande :

```
php artisan optimize:all
```

Cela permet de lancer toutes les commandes d'optimisation en une seule :

 - php artisan clear-compiled
 - php artisan optimize --force
 - php artisan config:cache
 - php artisan route:cache

Avec une compilation des vues Blade (qui était autrefois présente dans la commande "optimize").


## Utilisation de la commande "migrate:test"

Ajouter la commande à la liste des commandes dans la classe `app/Console/Kernel.php` :

```
'Axn\Illuminate\Foundation\Console\MigrateTest',
```

Pour lancer la commande :

```
php artisan migrate:test
```

Les options suivantes sont disponibles :

 * **--conn :** Connexion à utiliser dans config/database.php (par défaut : "testing")

Cela permet de tester, sur une connexion autre que celle principale, que les migrations
et seeds se lancent bien (pas d'exception levée en cours de migration/rollback/seeding).

Par défaut, la connexion "testing" est utilisée. Vous pouvez utliser la configuration
suivante pour celle-ci (à ajouter dans `config/database.php`, tableau "connections") :

```
'testing' => [
    'driver'   => 'sqlite',
    'database' => ':memory:',
    'prefix'   => '',
]
```


## Autre...

**Foundation/Testing/NestedViewsAssertions.php :**

En complément du trait `Illuminate\Foundation\Testing\AssertionsTrait` pour faire des
assertions sur les vues imbriquées.

**helpers.php :**

En complément des helpers de Laravel.
