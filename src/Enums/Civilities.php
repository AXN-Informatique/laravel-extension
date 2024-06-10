<?php

declare(strict_types=1);

namespace Axn\ToolKit\Enums;

enum Civilities: int
{
    case None = 0;

    case Mrs = 1;

    case Mr = 2;

    public function title(): string
    {
        return self::titles()[$this->value];
    }

    public function abbr(): string
    {
        return self::abbreviations()[$this->value];
    }

    /**
     * Returns an array of human readable values.
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
     * Returns an array of bootstrap colors values.
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
