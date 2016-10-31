Laravel Extension
=================

Includes a set of extensions to the Laravel framework 5.1+

* [Installation](#installation)
* [Eloquent](#eloquent)
  * [Natural sort](#natural-sort)
  * [Default model sort](#default-model-sort)
  * [Insert multiple records](#insert-multiple-records)
  * [Joints and relationships](#joints-and-relationships)
* [Artisan commands](#artisan-commands)
  * [optimize:all](#optimizeall)
  * [optimize:clear](#optimizeclear)
  * [migrate:test](#migratetest)
* [Blade directives](#blade-directives)
* [Logging configuration](#logging-configuration)
* [Other stuff](#other-stuff)
  * [Foundation/Testing/NestedViewsAssertionsTrait.php](#foundationtestingnestedviewsassertionstraitphp)
  * [helpers.php](#helpersphp)
  * [bootstrap.php](#bootstrapphp)

Installation
------------

Inclure le package avec Composer :

```sh
composer require axn/laravel-extension
```

Si vous souhaitez enregistrer l'ensemble des providers d'un coup, ajoutez le service
provider global au tableau des providers dans `config/app.php` :

```php
// config/app.php

'provider' => [
    //...
    Axn\Illuminate\ServiceProvider::class,
    //...
];
```

Sinon, vous pouvez choisir vous-mêmes les providers à utiliser (tous ces providers sont
compris dans le provider global ci-dessus) :

```php
// config/app.php

'provider' => [
    //...
    Axn\Illuminate\Database\DatabaseServiceProvider::class,
    Axn\Illuminate\Database\MigrationServiceProvider::class,
    Axn\Illuminate\Foundation\Providers\ArtisanServiceProvider::class,
    Axn\Illuminate\View\ViewServiceProvider::class,
    //...
];
```

Eloquent
--------

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

### Natural sort

La méthode `orderByNatural` a été ajoutée au Query Builder pour trier de manière naturelle sur les champs
contenant des données alphanumériques (voir : http://kumaresan-drupal.blogspot.fr/2012/09/natural-sorting-in-mysql-or.html).
Cette méthode s'utilise comme la méthode `orderBy`.

Exemple :

```php
DB::table('appartements')->orderByNatural('numero')->get();

// Descendant
DB::table('appartements')->orderByNatural('numero', 'desc')->get();
```

### Default model sort

Il est possible de spécifier un ordre de tri à appliquer par défaut pour les requêtes
de sélection. Pour cela, définir l'attribut `orderBy` dans le modèle, sous la forme :

```php
protected $orderBy = 'nom_champ';

// OR
protected $orderBy = [
    'nom_champ1' => 'option',
    'nom_champ2' => 'option',
    ...
];
```

`option` peut prendre les valeurs suivantes :

- asc
- desc
- natural
- natural_asc *(alias de "natural")*
- natural_desc

Exemple :

```php
class User extends Model
{
    use ModelTrait;

    protected $orderBy = [
        'lastname'  => 'asc',
        'firstname' => 'desc',
    ];
}
```

### Insert multiple records

Grâce à la méthode `createMany()` il est possible de créer plusieurs enregistrements en une seule requête,
tout comme il est possible de le faire avec la méthode `insert()` du QueryBuilder en lui passant
un tableau multidimensionnel, à la différence que `createMany()` va automatiquement renseigner
les champs `created_at` et `updated_at` comme le fait la méthode `create()`. 

**Attention : cette méthode ne déclenche pas les évènements et ne fait aucun retour !**

Exemple :

```php
Role::createMany([
    ['name' => 'supa'    , 'display_name' => 'Super-Administrateur'],
    ['name' => 'admin'   , 'display_name' => 'Administrateur'],
    ['name' => 'operator', 'display_name' => 'Opérateur']
]);
```

### Joints and relationships

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


Artisan commands
----------------

### optimize:all

Pour lancer la commande :

```
php artisan optimize:all
```

Cela permet de lancer toutes les commandes d'optimisation en une seule :

- php artisan optimize --force
- php artisan config:cache
- php artisan route:cache

Avec une compilation des vues Blade (qui était autrefois présente dans la commande "optimize").

### optimize:clear

Pour lancer la commande :

```
php artisan optimize:clear
```

Cela permet de lancer toutes les commandes de nettoyage des optimisations en une seule :

- php artisan route:clear
- php artisan config:clear
- php artisan clear-compiled

### migrate:test

Pour lancer la commande :

```
php artisan migrate:test
```

Les options suivantes sont disponibles :

* **--database :** Connexion à utiliser dans `config/database.php` (par défaut : "testing")
* **--seed :** Indique si la commande de seeding doit être lancée.

Cela permet de tester, sur une connexion autre que celle principale, que les migrations
et seeds se lancent bien (c'est-à-dire qu'aucune exception n'est levée).

Par défaut, la connexion "testing" est utilisée. Vous pouvez utliser la configuration
suivante pour celle-ci (à ajouter dans `config/database.php`, tableau "connections") :

```
'testing' => [
    'driver'   => 'sqlite',
    'database' => ':memory:',
    'prefix'   => '',
]
```

## Blade directives

L'extension fournie des directives additionnelles :

- @hasYield('nom-de-section') indique si une section donnée existe
- @hasNotYield('nom-de-section') la réciproque de la précédente

```php
@hasYield('section-a')
   // si une section "section-a" existe ...
@endif

@hasNotYield('section-b')
   // si une section "section-b" n'existe pas ...
@else
    //...
@endif
```

## Logging configuration

Laravel fournis un système de log basique, l'extension permet de configurer des logs un peu plus avancés.

Pour utiliser cette configuration avancée des logs vous devez ajouter sa prise en compte dans le fichier
``/bootstrap/app.php`` cherchez le code suivant :

```php
$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);
```

Et ajoutez en-dessous :

```php
// custom logging configuration
$app->configureMonologUsing(function($monolog) use ($app){
    (new Axn\Illuminate\Foundation\Bootstrap\ConfigureLogging($app))->configure($monolog);
});
```

Afin de modifier la configuration, vous pouvez publier le fichier de configuration :

```sh
php artisan vendor:publish --provider="Axn\Illuminate\ServiceProvider" --tag="config"
```


## Other stuff

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

### bootstrap.php

Comme le helpers.php ce fichier est inclu avec l'autoload de composer (c'est à dire très tôt).

Actuellement ce fichier comprend une initialisation des styles du dumper de variables
pour prendre les styles de Laravel plutôt que ceux de Symfony.

