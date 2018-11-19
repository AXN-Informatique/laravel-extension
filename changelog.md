Changelog for Laravel Extension
===============================

6.8.0 (2018-11-19)
------------------

- Add `Html::requiredCharacter()` html macro
- Remove the dependency on FontAwesome for requiredMarker

6.7.0 (2018-11-01)
------------------

- Add `number_formated()` helper
- Add `human_readable_bytes_size()` helper

6.6.0 (2018-10-29)
------------------

- Add `linebreaks()` helper
- Fix declaration of `str_html()` helper

6.5.0 (2018-10-04)
------------------

- Add `str_html()` helper
- Remove unused `dump_get()` helper

6.4.0 (2018-09-25)
------------------

- Add pattern parameter to `convert_dec_to_time()` helper
- Fix `compute_dec_to_time()` with list() called

6.3.0 (2018-09-25)
------------------

- Add `compute_dec_to_time()` helper

6.2.0 (2018-09-20)
------------------

- Add `convert_dec_to_time()` helper

6.1.0 (2018-09-11)
------------------

- add support for Laravel 5.7

6.0.1 (2018-09-03)
------------------

- Fix carbon() helper

6.0.0 (2018-07-20)
------------------

- Now contains only helpers, Blade directives and macros (Database has been moved to axn/laravel-database-extension)
- Blade directives `@hasyield` and `@doesnthaveyield` have been renamed `@hassection` and `@doesnthavesection`
- Helpers `dump_put()` and `v()` have been removed

5.4.1 (2018-07-20)
------------------

- Fix `carbon()` helper compatibility with Laravel < 5.5

5.4.0 (2018-07-13)
------------------

- Add number_fr() helper
- Rewrite carbon() helper
- Database :
    * joinRel : support des conditions additionnelles définies sur les relations
    * Possibilité de désactiver l'ordre par défaut défini sur le modèle

5.3.0 (2018-07-04)
------------------

- Add Laravel 5.6.* support
- Database :
    * joinRel : possibilité d'ajouter des conditions additionnelles

5.2.0 (2017-10-01)
------------------

- add support for Laravel 5.5

5.1.1 (2017-06-02)
------------------

- Database
    * fix DB connection resolver
    * fix Eloquent builder joinRel

5.1.0 (2017-02-06)
------------------

- Schema Builder : InnoDB as default engine

5.0.0 (2017-01-31)
------------------

- Add Laravel 5.4.* support

4.1.0 (2016-12-21)
------------------

- Add `Html::requiredMarker()` html macro
- fix translations (really)

4.0.2 (2016-12-21)
------------------

- fix translations

4.0.1 (2016-12-20)
------------------

- &nbsp; before required mark

4.0.0 (2016-12-20)
------------------

- Rename `hasYield` into `hasyield` - **bbc**
- Rename `hasNotYield` into `doesnthaveyield` - **bbc**
- Add `@endhasyield` directive
- Add `@enddoesnthaveyield` directive
- Add `@nltop()` directive
- Add `@nltobr()` directive
- Add `nl_to_p()` helper
- Add `Form::labelRequired()` form macro
- Add `Html::infoRequiredFields()` html macro

3.2.0 (2016-12-01)
------------------

- Add Laravel 5.3.* support

3.1.0 (2016-11-30)
------------------

- Add Laravel 5.2.* support

3.0.1 (2016-10-31)
------------------

- move to Github

3.0.0 (2016-10-08)
------------------

- Removing Laravel <= 5.1 compatibilities - **bbc**
- Added logs configurator

2.2.1 (2016-04-14)
------------------

- Fix Laravel v5.0 compatibility

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
