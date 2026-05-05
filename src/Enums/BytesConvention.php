<?php

declare(strict_types=1);

namespace Axn\ToolKit\Enums;

/**
 * Convention used to convert byte sizes into human-readable strings.
 *
 * - si  : decimal SI (base 1000, labels kB/MB/GB/TB), used by storage vendors and end users
 * - iec : binary IEC (base 1024, labels KiB/MiB/GiB/TiB), used by operating systems
 */
enum BytesConvention
{
    case si;

    case iec;

    /**
     * Get the divisor base for this convention.
     */
    public function base(): int
    {
        return match ($this) {
            self::si => 1000,
            self::iec => 1024,
        };
    }

    /**
     * Get the unit translation keys for this convention, ordered by power.
     *
     * @return list<string>
     */
    public function unitKeys(): array
    {
        return match ($this) {
            self::si => ['unit.B', 'unit.kB', 'unit.MB', 'unit.GB', 'unit.TB'],
            self::iec => ['unit.B', 'unit.KiB', 'unit.MiB', 'unit.GiB', 'unit.TiB'],
        };
    }
}
