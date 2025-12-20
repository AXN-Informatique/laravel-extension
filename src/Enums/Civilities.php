<?php

declare(strict_types=1);

namespace Axn\ToolKit\Enums;

/**
 * Civility/title enumeration for forms.
 */
enum Civilities: int
{
    case None = 0;

    case Mrs = 1;

    case Mr = 2;

    /**
     * Get the translated title for this civility.
     */
    public function title(): string
    {
        return self::titles()[$this->value];
    }

    /**
     * Get the translated abbreviation for this civility.
     */
    public function abbr(): string
    {
        return self::abbreviations()[$this->value];
    }

    /**
     * Get all civility titles indexed by value.
     *
     * @return array<int, string>
     */
    public static function titles(): array
    {
        return [
            self::None->value => '',
            self::Mrs->value => trans('civilities.mrs'),
            self::Mr->value => trans('civilities.mr'),
        ];
    }

    /**
     * Get all civility abbreviations indexed by value.
     *
     * @return array<int, string>
     */
    public static function abbreviations(): array
    {
        return [
            self::None->value => '',
            self::Mrs->value => trans('civilities.mrs_abbr'),
            self::Mr->value => trans('civilities.mr_abbr'),
        ];
    }
}
