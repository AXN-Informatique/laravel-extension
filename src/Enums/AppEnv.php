<?php

declare(strict_types=1);

namespace Axn\ToolKit\Enums;

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

    public static function name(self|string $name): string
    {
        return self::from($name)->name;
    }

    public static function isProd(self|string $env): bool
    {
        return \in_array(self::nameStringFromValue($env), self::PROD_NAMES);
    }

    public static function isNotProd(self|string $env): bool
    {
        return ! self::isPreprod($env);
    }

    public static function isPreprod(self|string $env): bool
    {
        return \in_array(self::nameStringFromValue($env), self::PREPROD_NAMES);
    }

    public static function isNotPreprod(self|string $env): bool
    {
        return ! self::isPreprod($env);
    }

    public static function isTest(self|string $env): bool
    {
        return \in_array(self::nameStringFromValue($env), self::TEST_NAMES);
    }

    public static function isNotTest(self|string $env): bool
    {
        return ! self::isTest($env);
    }

    public static function isLocal(self|string $env): bool
    {
        return \in_array(self::nameStringFromValue($env), self::LOCAL_NAMES);
    }

    public static function isNotLocal(self|string $env): bool
    {
        return ! self::isLocal($env);
    }

    public static function prodNames(): array
    {
        return self::PROD_NAMES;
    }

    public static function preprodNames(): array
    {
        return self::PREPROD_NAMES;
    }

    public static function testNames(): array
    {
        return self::TEST_NAMES;
    }

    public static function localNames(): array
    {
        return self::LOCAL_NAMES;
    }

    public static function nameStringFromValue(self|string $env): string
    {
        if ($env instanceof self) {
            return $env->name;
        }

        return str($env)->ascii()->lower()->toString();
    }
}
