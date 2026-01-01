# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Package Overview

Tool Kit for Laravel is a utility package providing helpers, Blade directives, components, and enums for Laravel applications. It requires PHP 8.4+ and Laravel 12.x.

**Namespace:** `Axn\ToolKit\`

## Development Commands

### Code Style & Quality

```bash
# Format code with Laravel Pint (PSR-12 + Laravel conventions)
./vendor/bin/pint

# Preview formatting changes without applying
./vendor/bin/pint --test

# Run Rector for automated refactoring and PHP modernization
./vendor/bin/rector

# Preview Rector changes without applying
./vendor/bin/rector --dry-run
```

### No Test Suite

This package currently has no automated tests. Manual testing should be performed in a Laravel application that requires this package.

## Architecture

### File Structure

- `src/helpers.php` - Global helper functions (auto-loaded via Composer)
- `src/ServiceProvider.php` - Registers Blade directives, components, and views
- `src/Enums/` - `AppEnv` (environment standardization) and `Civilities` (form titles)
- `src/MimeTypeToFontAwesomeIcon.php` - Static MIME type to FontAwesome icon mappings (FA5, FA6, FA7)
- `src/VersionNumber.php` - Semantic version to numeric ID conversion
- `src/Components/RequiredFieldMarker.php` - Blade component for form required indicators
- `resources/views/components/` - Blade view templates

### Key Patterns

**Helper Functions:** All helpers in `src/helpers.php` are globally available. Each function is wrapped in `if (!function_exists(...))` to allow application overrides.

**Enums:** The `AppEnv` enum normalizes various environment name variations (e.g., "pre-prod", "preproduction" → `preprod`). Use `app_env_enum()` or `app_env_name()` helpers.

**MIME Type Mapping:** The `MimeTypeToFontAwesomeIcon` class contains static arrays mapping MIME types to FontAwesome classes. FA7 has the most granular mappings (format-specific icons like `fa-file-png`, `fa-file-mp3`).

### Code Style Conventions

Based on `pint.json` configuration:
- Laravel preset (PSR-12 base)
- Native function calls must use backslash prefix in namespaced code (`\array_map`, `\count`)
- Blank lines required before control flow statements (`if`, `return`, `throw`, etc.)
- Named classes require parentheses on `new`, anonymous classes do not

### Rector Rules

The package uses aggressive modernization via Rector:
- All PHP 8.4 features enabled
- Dead code removal, strict booleans, early returns
- Laravel-specific: Eloquent type hints, nullsafe operators, validation array syntax
- Skipped: `FirstClassCallableRector` (preserves `array_map('intval', ...)` style)

## Dependencies

- `composer/semver` - For parsing semantic versions in `semver_to_id()`
- `forxer/generic-term-translations-for-laravel` - Provides translated terms for localization features

## Internationalization

Number formatting helpers (`number_formatted()`, `human_readable_bytes_size()`) use the current application locale for decimal/thousands separators. Ensure Laravel's locale is properly configured.
