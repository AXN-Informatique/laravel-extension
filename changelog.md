# Changelog for Laravel Extension

## 2.0.0-dev

- Ajout d'un provider pour enregistrer toutes les commandes.
- Ajout d'un provider pour enregistrer tous les providers et alias.
- Ajout d'un fichier de bootstrap pour modifier le handler du dumper de Symfony.
- Database :
    * Renommage du trait "Model" en "ModelTrait".
    * Ajout des méthodes rightJoinRel() et rightJoinRelWithTrashed() au builder.
- Foundation/Console :
    * Suppression du trait "Kernel" (solution non convainquante).
- Foundation/Testing :
    * Renommage du trait "NestedViewsAssertions" en "NestedViewsAssertionsTrait".
- Helpers :
    * Suppression de vd() - Utiliser dump() à la place.
    * Suppression de dw() - Utiliser dump_put() à la place.
    * Suppression de dump_html() - Utiliser dump_get() à la place.
    * Simplification de v().
    * Suppression de vv() - Utiliser data_get() à la place.
    * Ajout du helper collect_models().

## 1.2.4 (2015-11-30)

- Foundation/Console : ajout de l'extension du ConsoleKernel (trait).

## 1.2.3 (2015-11-24)

- Helper d() renommé dump_html() pour avoir un nom plus parlant, et utilisation
  du HtmlDumper pour avoir un retour HTML même en console.

## 1.2.2 (2015-11-23)

- Helper dump() renommé d() car nom déjà utilisé par Symfony...

## 1.2.1 (2015-11-23)

- Helper dump() : ob_get_clean() et non ob_end_clean().

## 1.2.0 (2015-11-23)

- Database : ajout de la possibilité de spécifier un ordre par défaut.
- Foundation/Console : ajout de la commande artisan "optimize:clear".
- Foundation/Console : suppression de "clear-compiled" de la commande "optimize:all".
- Foundation/Console : affichage de la trace si exception catched dans la commande "migrate:test".
- Ajout du helper dump().
- Nettoyage commentaires.

## 1.1.0 (2015-10-26)

- Ajout du helper vv().

## 1.0.1 (2015-10-22)

- Changements mineurs au niveau des couleurs en console.
- Correction du retour de la fonction helper v().

## 1.0.0 (2015-09-08)

- First release.
