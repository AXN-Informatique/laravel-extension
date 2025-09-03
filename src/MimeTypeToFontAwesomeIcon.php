<?php

declare(strict_types=1);

namespace Axn\ToolKit;

class MimeTypeToFontAwesomeIcon
{
    private const FA5_MAPPINGS = [
        'image' => 'fa-file-image',
        'audio' => 'fa-file-audio',
        'video' => 'fa-file-video',

        'application/pdf' => 'fa-file-pdf',

        'application/msword' => 'fa-file-word',
        'application/vnd.ms-word' => 'fa-file-word',
        'application/vnd.oasis.opendocument.text' => 'fa-file-word',
        'application/vnd.openxmlformats-officedocument.wordprocessingml' => 'fa-file-word',

        'application/vnd.ms-excel' => 'fa-file-excel',
        'application/vnd.openxmlformats-officedocument.spreadsheetml' => 'fa-file-excel',
        'application/vnd.oasis.opendocument.spreadsheet' => 'fa-file-excel',

        'application/vnd.ms-powerpoint' => 'fa-file-powerpoint',
        'application/vnd.openxmlformats-officedocument.presentationml' => 'fa-file-powerpoint',
        'application/vnd.oasis.opendocument.presentation' => 'fa-file-powerpoint',

        'text/plain' => 'fa-file-alt',

        'text/html' => 'fa-file-code',
        'application/json' => 'fa-file-code',

        'application/gzip' => 'fa-file-archive',
        'application/zip' => 'fa-file-archive',
        'application/x-7z-compressed' => 'fa-file-archive',
    ];

    private const FA6_MAPPINGS = [
        'image' => 'fa-file-image',
        'audio' => 'fa-file-audio',
        'video' => 'fa-file-video',

        'application/pdf' => 'fa-file-pdf',

        'application/msword' => 'fa-file-word',
        'application/vnd.ms-word' => 'fa-file-word',
        'application/vnd.oasis.opendocument.text' => 'fa-file-word',
        'application/vnd.openxmlformats-officedocument.wordprocessingml' => 'fa-file-word',

        'application/vnd.ms-excel' => 'fa-file-excel',
        'application/vnd.openxmlformats-officedocument.spreadsheetml' => 'fa-file-excel',
        'application/vnd.oasis.opendocument.spreadsheet' => 'fa-file-excel',

        'application/vnd.ms-powerpoint' => 'fa-file-powerpoint',
        'application/vnd.openxmlformats-officedocument.presentationml' => 'fa-file-powerpoint',
        'application/vnd.oasis.opendocument.presentation' => 'fa-file-powerpoint',

        'text/plain' => 'fa-lines',

        'text/html' => 'fa-file-code',
        'application/json' => 'fa-file-code',

        'application/gzip' => 'fa-file-zipper',
        'application/zip' => 'fa-file-zipper',
        'application/x-7z-compressed' => 'fa-file-zipper',
    ];

    private const FA7_MAPPINGS = [
        'image' => 'fa-file-image',
        'audio' => 'fa-file-audio',
        'video' => 'fa-file-video',

        'application/pdf' => 'fa-file-pdf',

        'application/msword' => 'fa-file-word',
        'application/vnd.ms-word' => 'fa-file-word',
        'application/vnd.oasis.opendocument.text' => 'fa-file-word',
        'application/vnd.openxmlformats-officedocument.wordprocessingml' => 'fa-file-word',

        'application/vnd.ms-excel' => 'fa-file-excel',
        'application/vnd.openxmlformats-officedocument.spreadsheetml' => 'fa-file-excel',
        'application/vnd.oasis.opendocument.spreadsheet' => 'fa-file-excel',

        'application/vnd.ms-powerpoint' => 'fa-file-powerpoint',
        'application/vnd.openxmlformats-officedocument.presentationml' => 'fa-file-powerpoint',
        'application/vnd.oasis.opendocument.presentation' => 'fa-file-powerpoint',

        'text/plain' => 'fa-lines',

        'text/html' => 'fa-file-code',
        'application/json' => 'fa-file-code',

        'application/gzip' => 'fa-file-zipper',
        'application/zip' => 'fa-file-zipper',
        'application/x-7z-compressed' => 'fa-file-zipper',
    ];

    public static function toFa5Class(string $mimeType, string $default = 'fa-file'): string
    {
        return self::findIconClass($mimeType, self::FA5_MAPPINGS, $default);
    }

    public static function toFa6Class(string $mimeType, string $default = 'fa-file'): string
    {
        return self::findIconClass($mimeType, self::FA6_MAPPINGS, $default);
    }

    public static function toFa7Class(string $mimeType, string $default = 'fa-file'): string
    {
        return self::findIconClass($mimeType, self::FA7_MAPPINGS, $default);
    }

    private static function findIconClass(string $inputMimeType, array $mappings, string $default): string
    {
        foreach ($mappings as $mimeType => $iconClass) {
            if (str_starts_with($inputMimeType, $mimeType)) {
                return $iconClass;
            }
        }

        return $default;
    }
}
