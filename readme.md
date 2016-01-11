# Laravel Extension

Ce package regroupe toutes les extensions faites du framework Laravel 5.

## Installation

Inclure le package avec Composer :

```
composer require axn/laravel-extension
```

Si vous souhaitez enregistrer l'ensemble des extensions d'un coup, ajoutez le service
provider global au tableau des providers dans `config/app.php` :

```
'Axn\Illuminate\ServiceProvider',
```

## Utilisation de l'extension d'Eloquent

Si vous n'utilisez pas le provider global, ajoutez le service provider suivant au
tableau des providers dans `config/app.php` :

```
'Axn\Illuminate\Database\DatabaseServiceProvider',
```

Ajoutez le trait `Axn\Illuminate\Database\Eloquent\ModelTrait` aux modèles pour lesquels
l'extension d'Eloquent est souhaitée :

```php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Axn\Illuminate\Database\Eloquent\ModelTrait;

class User extends Model
{
    use ModelTrait;

    // ...
}
```

### Ordonnement par défaut

Il est possible de spécifier un ordonnement à appliquer par défaut pour les requêtes
de sélection. Pour cela, définir l'attribut `orderBy` dans le modèle.

Exemple :

```php
class User extends Model
{
    use EloquentExtension;

    protected $orderBy = [
        'lastname' => 'asc',
        'firstname' => 'asc'
    ];
}
```

### Insertion de plusieurs enregistrements en une requête

Grâce à la méthode `createMany()` il est possible de créer plusieurs enregistrements en une seule requête,
tout comme il est possible de le faire avec la méthode `insert()` du QueryBuilder en lui passant
un tableau multidimensionnel, à la différence que `createMany()` va automatiquement renseigner
les champs `created_at` et `updated_at` comme le fait la méthode `create()`. **Par contre attention :
cette méthode ne déclenche pas les évènements et ne fait aucun retour !**

Exemple :

```php
Role::createMany([
    ['name' => 'supa'    , 'display_name' => 'Super-Administrateur'],
    ['name' => 'admin'   , 'display_name' => 'Administrateur'],
    ['name' => 'operator', 'display_name' => 'Opérateur']
]);
```

### Jointures via relations

Des jointures peuvent être effectuées en utilisant les relations definies dans le modèle.

Attention : seules les relations BelongsTo, HasOneOrMany et MorphOneOrMany sont gérées. Ainsi,
pour joindre une table en relation BelongsToMany, il faut d'abord passé par la table pivot.

Exemple :

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

Des alias à joinRel() sont également disponibles pour faire des jointures LEFT/RIGHT
ou pour inclure les enregistrements "soft deleted" :

- joinRelWithTrashed()
- leftJoinRel()
- leftJoinRelWithTrashed()
- rightJoinRel()
- rightJoinRelWithTrashed()

## Commandes Artisan

Si vous n'utilisez pas le provider global, ajoutez le service provider suivant au
tableau des providers dans `config/app.php` :

```
'Axn\Illuminate\Foundation\Providers\ArtisanServiceProvider',
```

### Commande "optimize:all"

Pour lancer la commande :

```
php artisan optimize:all
```

Cela permet de lancer toutes les commandes d'optimisation en une seule :

- php artisan optimize --force
- php artisan config:cache
- php artisan route:cache

Avec une compilation des vues Blade (qui était autrefois présente dans la commande "optimize").

### Commande "optimize:clear"

Pour lancer la commande :

```
php artisan optimize:clear
```

Cela permet de lancer toutes les commandes de nettoyage des optimisations en une seule :

- php artisan route:clear
- php artisan config:clear
- php artisan clear-compiled

### Commande "migrate:test"

Pour lancer la commande :

```
php artisan migrate:test
```

Les options suivantes sont disponibles :

* **--conn :** Connexion à utiliser dans `config/database.php` (par défaut : "testing")

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

### Foundation/Testing/NestedViewsAssertionsTrait.php

En complément du trait `Illuminate\Foundation\Testing\AssertionsTrait` pour faire des
assertions sur les vues imbriquées. À ajouter à la classe `TestCase` :

```php
use Axn\Illuminate\Foundation\Testing\NestedViewsAssertionsTrait;

class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    use NestedViewsAssertionsTrait;

    // ...
}
```

### helpers.php

En complément des helpers de Laravel :

- **dump_get()**       : Retourne le résultat d'un dump obtenu à l'aide du dumper HTML de Laravel.
- **dump_put()**       : Écrit dans "public/dump.html" le résultat d'un dump obtenu à l'aide du dumper HTML de Laravel.
- **v()**              : Tente de retourner la valeur d'une variable, sans générer d'erreur si celle-ci n'existe pas.
- **carbon()**         : Crée une instance Carbon à partir d'une date ou d'un timestamp.
- **collect_models()** : Crée une collection de modèles (entités Eloquent).
