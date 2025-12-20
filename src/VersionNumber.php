<?php

declare(strict_types=1);

namespace Axn\ToolKit;

use Composer\Semver\VersionParser;
use UnexpectedValueException;

class VersionNumber
{
    /**
     * Transform a semver version number into a numeric identifier.
     *
     * Important: does not support pre-release versions (RC, beta, etc.)
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
