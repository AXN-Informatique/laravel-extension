Changelog
=========

8.0.0 (2022-08-14)
------------------

- Removed support of Laravel 7 and earlier
- Removed support of PHP 7 and earlier
- Removed deprecated hassection blade directive, use native @hasSection instead
- Removed deprecated endhassection blade directive, use native @endif instead
- Removed deprecated doesnthavesection blade directive, use native @sectionMissing instead
- Removed deprecated enddoesnthavesection blade directive, use native @endif instead


7.7.2 (2022-08-12)
------------------

- Added `visually-hidden` class to `requiredMarker` html macro for Bootstrap 5

7.7.1 (2022-06-08)
------------------

- Fixed import of `ReflectionClass` in helpers file

7.7.0 (2022-06-08)
------------------

- Added `is_valid_model()` helper

7.6.0 (2022-02-11)
------------------

- Added support for Laravel 9

7.5.2 (2022-01-23)
------------------

- Deprecated `@hassection` will be removed in 8.0.0 ; use native `@hasSection` instead
- Deprecated `@doesnthavesection` will be removed in 8.0.0 ; use native `@sectionMissing` instead
- As the methods are called in the `boot()` method of the service provider, there is no need to check if the required services are loaded

7.5.1 (2021-06-17)
------------------

- Missing return directive

7.5.0 (2021-06-17)
------------------

- Added nl_to_br() helper

7.4.0 (2021-01-06)
------------------

- Added trans_ucfirst() helper

7.3.0 (2020-11-09)
------------------

- Added mime_type_to_fa5_class() helper

7.2.0 (2020-09-24)
------------------

- Added support for Laravel 8

7.1.1 (2020-03-05)
------------------

- Fixed dependencies constraints

7.1.0 (2020-03-04)
------------------

- Added support for Laravel 7

7.0.0 (2019-12-27)
------------------

- Added support for Laravel 6
- Droped support for Laravel 5.7 and older

6.9.0 (2019-03-07)
------------------

- Added support for Laravel 5.8

6.8.0 (2018-11-19)
------------------

- Added `Html::requiredCharacter()` html macro
- Removed the dependency on FontAwesome for requiredMarker

6.7.0 (2018-11-01)
------------------

- Added `number_formated()` helper
- Added `human_readable_bytes_size()` helper

6.6.0 (2018-10-29)
------------------

- Added `linebreaks()` helper
- Fixed declaration of `str_html()` helper

6.5.0 (2018-10-04)
------------------

- Added `str_html()` helper
- Removed unused `dump_get()` helper

6.4.0 (2018-09-25)
------------------

- Added pattern parameter to `convert_dec_to_time()` helper
- Fix `compute_dec_to_time()` with list() called

6.3.0 (2018-09-25)
------------------

- Added `compute_dec_to_time()` helper

6.2.0 (2018-09-20)
------------------

- Added `convert_dec_to_time()` helper

6.1.0 (2018-09-11)
------------------

- Added support for Laravel 5.7

6.0.1 (2018-09-03)
------------------

- Fixed carbon() helper

6.0.0 (2018-07-20)
------------------

- Now contains only helpers, Blade directives and macros (Database has been moved to axn/laravel-database-extension)
- Blade directives `@hasyield` and `@doesnthaveyield` have been renamed `@hassection` and `@doesnthavesection`
- Helpers `dump_put()` and `v()` have been removed

5.4.1 (2018-07-20)
------------------

- Fixed `carbon()` helper compatibility with Laravel < 5.5

5.4.0 (2018-07-13)
------------------

- Added number_fr() helper
- Rewrite carbon() helper
- Database :
    * joinRel : support des conditions additionnelles définies sur les relations
    * Possibilité de désactiver l'ordre par défaut défini sur le modèle

5.3.0 (2018-07-04)
------------------

- Added Laravel 5.6.* support
- Database :
    * joinRel : possibilité d'ajouter des conditions additionnelles

5.2.0 (2017-10-01)
------------------

- Added support for Laravel 5.5

5.1.1 (2017-06-02)
------------------

- Database
    * fixed DB connection resolver
    * fixed Eloquent builder joinRel

5.1.0 (2017-02-06)
------------------

- Schema Builder : InnoDB as default engine

5.0.0 (2017-01-31)
------------------

- Added Laravel 5.4.* support

4.1.0 (2016-12-21)
------------------

- Added `Html::requiredMarker()` html macro
- Fixed translations (really)

4.0.2 (2016-12-21)
------------------

- Fixed translations

4.0.1 (2016-12-20)
------------------

- &nbsp; before required mark

4.0.0 (2016-12-20)
------------------

- Renamed `hasYield` into `hasyield` - **bbc**
- Renamed `hasNotYield` into `doesnthaveyield` - **bbc**
- Added `@endhasyield` directive
- Added `@enddoesnthaveyield` directive
- Added `@nltop()` directive
- Added `@nltobr()` directive
- Added `nl_to_p()` helper
- Added `Form::labelRequired()` form macro
- Added `Html::infoRequiredFields()` html macro

3.2.0 (2016-12-01)
------------------

- Added Laravel 5.3.* support

3.1.0 (2016-11-30)
------------------

- Added Laravel 5.2.* support

3.0.1 (2016-10-31)
------------------

- Moved to Github

3.0.0 (2016-10-08)
------------------

- Removed Laravel <= 5.1 compatibilities - **bbc**
- Added logs configurator

2.2.1 (2016-04-14)
------------------

- Fixed Laravel v5.0 compatibility

2.2.0 (2016-04-14)
------------------

- Database :
    * Ajout macro "orderByNatural" au Query Builder.
    * ModelTrait : nouvelles options disponibles pour ORDER BY par défaut.

2.1.4 (2016-03-22)
------------------

- Source code released with the MIT license
- Added license file

2.1.3 (2016-03-03)
------------------

- Database : bind() à la place de singleton() pour enregistrer MySqlConnection.

2.1.2 (2016-02-23)
------------------

- Database :
    * ModelTrait::createMany() : limitation du nombre d'enregistrements par requête (50 par défaut).
    * Désactivation de l'ORDER BY par défaut si jointure.

2.1.1 (2016-01-13)
------------------

- Fix compatibilité Laravel v5.0
- laravel/framework en dépendance au lieu de illuminate/support

2.1.0 (2016-01-13)
------------------

- Ajout de directives personnalisées hasYield et hasNotYield à Blade

2.0.0 (2016-01-12)
------------------

- Ajout d'un provider pour enregistrer toutes les commandes.
- Ajout d'un provider pour enregistrer tous les providers et alias.
- Ajout d'un fichier de bootstrap pour modifier le handler du dumper de Symfony.
- Database :
    * Renommage du trait "Model" en "ModelTrait". - **bbc**
    * Ajout des méthodes rightJoinRel() et rightJoinRelWithTrashed() au builder.
- Foundation/Console :
    * Suppression du trait "Kernel" (solution non convainquante). - **bbc**
    * Commande MigrateTest : renommage, déplacement, ajout/renommage d'options.
- Foundation/Testing :
    * Renommage du trait "NestedViewsAssertions" en "NestedViewsAssertionsTrait".
- Helpers :
    * Suppression de vd() - Utiliser dump() à la place.
    * Suppression de dw() - Utiliser dump_put() à la place.
    * Suppression de dump_html() - Utiliser dump_get() à la place.
    * Simplification de v().
    * Suppression de vv() - Utiliser data_get() à la place.
    * Ajout du helper collect_models().

1.2.4 (2015-11-30)
------------------

- Foundation/Console : ajout de l'extension du ConsoleKernel (trait).

1.2.3 (2015-11-24)
------------------

- Helper d() renommé dump_html() pour avoir un nom plus parlant, et utilisation
  du HtmlDumper pour avoir un retour HTML même en console.

1.2.2 (2015-11-23)
------------------

- Helper dump() renommé d() car nom déjà utilisé par Symfony...

1.2.1 (2015-11-23)
------------------

- Helper dump() : ob_get_clean() et non ob_end_clean().

1.2.0 (2015-11-23)
------------------

- Database : ajout de la possibilité de spécifier un ordre par défaut.
- Foundation/Console : ajout de la commande artisan "optimize:clear".
- Foundation/Console : suppression de "clear-compiled" de la commande "optimize:all".
- Foundation/Console : affichage de la trace si exception catched dans la commande "migrate:test".
- Ajout du helper dump().
- Nettoyage commentaires.

1.1.0 (2015-10-26)
------------------

- Ajout du helper vv().

1.0.1 (2015-10-22)
------------------

- Changements mineurs au niveau des couleurs en console.
- Correction du retour de la fonction helper v().

1.0.0 (2015-09-08)
------------------

- First release.
