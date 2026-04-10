# Tool Kit for Laravel

- Boîte à outils Laravel fournissant des helpers PHP, directives Blade, un composant et des enums utilitaires.
- Helpers texte : `nl_to_br()`, `nl_to_br_compact()`, `nl_to_p()`, `nl_to_p_flat()`, `linebreaks()`, `str_html()`, `trans_lcfirst()`, `trans_ucfirst()`.
- Helpers nombres/formats : `number_formatted()`, `human_readable_bytes_size()`, `compute_dec_to_time()`, `convert_dec_to_time()`, `semver_to_id()`.
- Helpers divers : `carbon()`, `collect_models()`, `app_env_enum()`, `app_env_name()`, `is_valid_model()`, `mime_type_to_fa5_class()`, `mime_type_to_fa6_class()`, `mime_type_to_fa7_class()`.
- Directives Blade : `@nltobr`, `@nltobrcompact`, `@nltop`, `@nltopflat`.
- Composant : `<x-required-field-marker />` — marqueur champ obligatoire (astérisque accessible).
- Enums : `AppEnv` (normalise les environnements : `prod`, `preprod`, `test`, `local`, `unknown`) et `Civilities` (civilités avec traductions).
- Les helpers de formatage de nombres (`number_formatted()`, `human_readable_bytes_size()`) utilisent la locale courante de l'application.
- Chaque helper est protégé par `if (!function_exists(...))`, l'application peut les surcharger.
