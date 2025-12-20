<?php

declare(strict_types=1);

namespace Axn\ToolKit\Enums;

/**
 * Standardized application environment enumeration.
 *
 * Normalizes various environment name variations to standard cases.
 */
enum AppEnv
{
    case prod;

    case preprod;

    case test;

    case local;

    case unknown;

    private const PROD_NAMES = [
        'prod', 'production',
    ];

    private const PREPROD_NAMES = [
        'preprod', 'pre-prod', 'preproduction', 'pre-production',
    ];

    private const TEST_NAMES = [
        'test', 'tests', 'testing', 'stage', 'staging',
    ];

    private const LOCAL_NAMES = [
        'local', 'develop', 'dev',
    ];

    /**
     * Create an AppEnv instance from a string or enum value.
     */
    public static function from(self|string $name): self
    {
        if (self::isProd($name)) {
            return self::prod;
        }

        if (self::isPreprod($name)) {
            return self::preprod;
        }

        if (self::isTest($name)) {
            return self::test;
        }

        if (self::isLocal($name)) {
            return self::local;
        }

        return self::unknown;
    }

    /**
     * Get the standardized name of an environment.
     */
    public static function name(self|string $name): string
    {
        return self::from($name)->name;
    }

    /**
     * Check if the environment is production.
     */
    public static function isProd(self|string $env): bool
    {
        return \in_array(self::nameStringFromValue($env), self::PROD_NAMES);
    }

    /**
     * Check if the environment is not production.
     */
    public static function isNotProd(self|string $env): bool
    {
        return ! self::isProd($env);
    }

    /**
     * Check if the environment is pre-production.
     */
    public static function isPreprod(self|string $env): bool
    {
        return \in_array(self::nameStringFromValue($env), self::PREPROD_NAMES);
    }

    /**
     * Check if the environment is not pre-production.
     */
    public static function isNotPreprod(self|string $env): bool
    {
        return ! self::isPreprod($env);
    }

    /**
     * Check if the environment is test/staging.
     */
    public static function isTest(self|string $env): bool
    {
        return \in_array(self::nameStringFromValue($env), self::TEST_NAMES);
    }

    /**
     * Check if the environment is not test/staging.
     */
    public static function isNotTest(self|string $env): bool
    {
        return ! self::isTest($env);
    }

    /**
     * Check if the environment is local/development.
     */
    public static function isLocal(self|string $env): bool
    {
        return \in_array(self::nameStringFromValue($env), self::LOCAL_NAMES);
    }

    /**
     * Check if the environment is not local/development.
     */
    public static function isNotLocal(self|string $env): bool
    {
        return ! self::isLocal($env);
    }

    /**
     * Get all recognized production environment names.
     *
     * @return list<string>
     */
    public static function prodNames(): array
    {
        return self::PROD_NAMES;
    }

    /**
     * Get all recognized pre-production environment names.
     *
     * @return list<string>
     */
    public static function preprodNames(): array
    {
        return self::PREPROD_NAMES;
    }

    /**
     * Get all recognized test/staging environment names.
     *
     * @return list<string>
     */
    public static function testNames(): array
    {
        return self::TEST_NAMES;
    }

    /**
     * Get all recognized local/development environment names.
     *
     * @return list<string>
     */
    public static function localNames(): array
    {
        return self::LOCAL_NAMES;
    }

    /**
     * Convert an environment value to its lowercase ASCII string representation.
     */
    public static function nameStringFromValue(self|string $env): string
    {
        if ($env instanceof self) {
            return $env->name;
        }

        return str($env)->ascii()->lower()->toString();
    }
}
