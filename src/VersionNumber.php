<?php

declare(strict_types=1);

namespace Axn\ToolKit;

use Composer\Semver\VersionParser;
use UnexpectedValueException;

class VersionNumber
{
    /**
     * Transforme un numéro de version semver en un identifiant numérique.
     *
     * Note importante : ne prend pas en charge les versions non finalisée (RC, beta, etc.)
     *
     * @throws UnexpectedValueException
     */
    public static function toId(string $version): int
    {
        $versionParser = new VersionParser();

        $versionNormalized = $versionParser->normalize($version);

        $versionParts = explode('.', $versionNormalized);

        return $versionParts[0] * 10000 + $versionParts[1] * 100 + $versionParts[2];
    }
}
