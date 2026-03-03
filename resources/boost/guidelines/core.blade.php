## tool-kit-for-laravel

Boîte à outils Laravel : helpers PHP, directives Blade, composants et enums utilitaires.

### Helpers — Texte et HTML
- `nl_to_br($str)`, `nl_to_br_compact($str)` — newlines → `<br>`
- `nl_to_p($str)`, `nl_to_p_flat($str)` — newlines → `<p>` / `<br>`
- `linebreaks($str)` — normalise les fins de ligne en UNIX (`\n`)
- `str_html($str)` — retourne un `HtmlString`
- `trans_ucfirst($key)` — traduit avec première lettre en majuscule

### Helpers — Nombres et formats
- `number_formatted($value, $decimals, $trimZeroDecimals)` — nombre selon la locale
- `human_readable_bytes_size($bytes, $decimals, $trimZeroDecimals)` — taille lisible (`2 ko`, `19,53 Go`)
- `compute_dec_to_time($n)` — décimal → `['hours', 'minutes', 'seconds']`
- `convert_dec_to_time($n, $format)` — décimal → chaîne (`"01:45:00"`, `"01h45"`)
- `semver_to_id('8.2.14')` — semver → entier numérique (`80214`)

### Helpers — Divers
- `carbon(...)` — création Carbon flexible (string, timestamp, format, timezone)
- `collect_models([$m1, $m2])` — collection Eloquent depuis un tableau de models
- `app_env_enum()` — retourne `AppEnv` enum depuis `app.env`
- `app_env_name()` — retourne le nom normalisé de l'env (`'prod'`, `'local'`, ...)
- `is_valid_model(User::class)` — vérifie qu'une classe est un modèle Eloquent instanciable
- `mime_type_to_fa5_class($mime)`, `mime_type_to_fa6_class($mime)`, `mime_type_to_fa7_class($mime)` — MIME → classe FontAwesome

### Directives Blade
- `@nltobr($str)`, `@nltobrcompact($str)`, `@nltop($str)`, `@nltopflat($str)`

### Composant
- `<x-required-field-marker />` — marqueur champ obligatoire (astérisque accessible)

### Enums
- `AppEnv` — normalise les environnements (`prod`, `preprod`, `test`, `local`, `unknown`)
- `Civilities` — civilités avec traductions (`None`, `Mrs`, `Mr`)
