<?php

declare(strict_types=1);

namespace Axn\ToolKit;

class MimeTypeToFontAwesomeIcon
{
    private const array FA5_MAPPINGS = [
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

    private const array FA6_MAPPINGS = [
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

    private const array FA7_MAPPINGS = [
        // Images
        'image/jpeg' => 'fa-file-image',
        'image/jpg' => 'fa-file-image',
        'image/png' => 'fa-file-image',
        'image/gif' => 'fa-file-image',
        'image/webp' => 'fa-file-image',
        'image/svg+xml' => 'fa-file-image',
        'image/avif' => 'fa-file-image',
        'image/bmp' => 'fa-file-image',
        'image/tiff' => 'fa-file-image',
        'image/x-icon' => 'fa-file-image',
        'image' => 'fa-file-image',

        // Audio
        'audio/mpeg' => 'fa-file-audio',
        'audio/mp3' => 'fa-file-audio',
        'audio/wav' => 'fa-file-audio',
        'audio/x-wav' => 'fa-file-audio',
        'audio/ogg' => 'fa-file-audio',
        'audio/webm' => 'fa-file-audio',
        'audio/flac' => 'fa-file-audio',
        'audio/aac' => 'fa-file-audio',
        'audio/midi' => 'fa-file-audio',
        'audio/x-midi' => 'fa-file-audio',
        'audio/x-m4a' => 'fa-file-audio',
        'audio' => 'fa-file-audio',

        // Video
        'video/mp4' => 'fa-file-video',
        'video/mpeg' => 'fa-file-video',
        'video/quicktime' => 'fa-file-video',
        'video/x-msvideo' => 'fa-file-video',
        'video/x-ms-wmv' => 'fa-file-video',
        'video/webm' => 'fa-file-video',
        'video/ogg' => 'fa-file-video',
        'video/3gpp' => 'fa-file-video',
        'video/3gpp2' => 'fa-file-video',
        'video' => 'fa-file-video',

        // PDF
        'application/pdf' => 'fa-file-pdf',
        'application/x-pdf' => 'fa-file-pdf',

        // Word documents
        'application/msword' => 'fa-file-word',
        'application/vnd.ms-word' => 'fa-file-word',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'fa-file-word',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.template' => 'fa-file-word',
        'application/vnd.oasis.opendocument.text' => 'fa-file-word',
        'application/vnd.openxmlformats-officedocument.wordprocessingml' => 'fa-file-word',
        'application/rtf' => 'fa-file-word',

        // Excel/Spreadsheets
        'application/vnd.ms-excel' => 'fa-file-excel',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' => 'fa-file-excel',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.template' => 'fa-file-excel',
        'application/vnd.openxmlformats-officedocument.spreadsheetml' => 'fa-file-excel',
        'application/vnd.oasis.opendocument.spreadsheet' => 'fa-file-excel',
        'text/csv' => 'fa-file-csv',
        'application/csv' => 'fa-file-csv',
        'text/tab-separated-values' => 'fa-file-csv',

        // PowerPoint/Presentations
        'application/vnd.ms-powerpoint' => 'fa-file-powerpoint',
        'application/vnd.openxmlformats-officedocument.presentationml.presentation' => 'fa-file-powerpoint',
        'application/vnd.openxmlformats-officedocument.presentationml.template' => 'fa-file-powerpoint',
        'application/vnd.openxmlformats-officedocument.presentationml.slideshow' => 'fa-file-powerpoint',
        'application/vnd.openxmlformats-officedocument.presentationml' => 'fa-file-powerpoint',
        'application/vnd.oasis.opendocument.presentation' => 'fa-file-powerpoint',

        // Text files
        'text/plain' => 'fa-file-lines',
        'text/markdown' => 'fa-file-lines',
        'text/x-markdown' => 'fa-file-lines',

        // Code files
        'text/html' => 'fa-file-code',
        'text/xml' => 'fa-file-code',
        'application/xml' => 'fa-file-code',
        'application/xhtml+xml' => 'fa-file-code',
        'application/json' => 'fa-file-code',
        'application/ld+json' => 'fa-file-code',
        'text/javascript' => 'fa-file-code',
        'application/javascript' => 'fa-file-code',
        'application/x-javascript' => 'fa-file-code',
        'text/css' => 'fa-file-code',
        'application/x-httpd-php' => 'fa-file-code',
        'application/x-sh' => 'fa-file-code',
        'text/x-python' => 'fa-file-code',
        'text/x-java-source' => 'fa-file-code',
        'text/x-c' => 'fa-file-code',
        'text/x-c++' => 'fa-file-code',
        'application/sql' => 'fa-file-code',
        'text/yaml' => 'fa-file-code',
        'application/x-yaml' => 'fa-file-code',

        // Archives
        'application/gzip' => 'fa-file-zipper',
        'application/x-gzip' => 'fa-file-zipper',
        'application/zip' => 'fa-file-zipper',
        'application/x-zip' => 'fa-file-zipper',
        'application/x-zip-compressed' => 'fa-file-zipper',
        'application/x-7z-compressed' => 'fa-file-zipper',
        'application/x-rar' => 'fa-file-zipper',
        'application/x-rar-compressed' => 'fa-file-zipper',
        'application/x-tar' => 'fa-file-zipper',
        'application/x-bzip' => 'fa-file-zipper',
        'application/x-bzip2' => 'fa-file-zipper',
        'application/vnd.rar' => 'fa-file-zipper',

        // Fonts
        'font/ttf' => 'fa-file-font',
        'font/otf' => 'fa-file-font',
        'font/woff' => 'fa-file-font',
        'font/woff2' => 'fa-file-font',
        'application/vnd.ms-fontobject' => 'fa-file-font',
        'application/font-woff' => 'fa-file-font',
        'application/font-woff2' => 'fa-file-font',
        'application/x-font-ttf' => 'fa-file-font',
        'application/x-font-truetype' => 'fa-file-font',
        'application/x-font-opentype' => 'fa-file-font',

        // Certificates/Security
        'application/x-x509-ca-cert' => 'fa-file-certificate',
        'application/x-pem-file' => 'fa-file-certificate',
        'application/pkix-cert' => 'fa-file-certificate',
        'application/x-pkcs12' => 'fa-file-certificate',

        // Medical
        'application/dicom' => 'fa-file-medical',

        // Contracts/Signatures  
        'application/vnd.adobe.xfdf' => 'fa-file-signature',
        'application/vnd.adobe.xdp+xml' => 'fa-file-signature',

        // Invoices/Financial
        'application/vnd.openxmlformats-officedocument.invoice' => 'fa-file-invoice',
        'application/edi' => 'fa-file-invoice',
        'application/edifact' => 'fa-file-invoice',
        'application/edi-x12' => 'fa-file-invoice',

        // E-books
        'application/epub+zip' => 'fa-file-lines',
        'application/x-mobipocket-ebook' => 'fa-file-lines',

        // Vector graphics
        'application/postscript' => 'fa-file-vector',
        'application/illustrator' => 'fa-file-vector',
        'image/x-eps' => 'fa-file-vector',

        // Binaries/Executables
        'application/octet-stream' => 'fa-file-binary',
        'application/x-executable' => 'fa-file-binary',
        'application/x-msdownload' => 'fa-file-binary',
        'application/x-msdos-program' => 'fa-file-binary',

        // Calendar
        'text/calendar' => 'fa-file-calendar',
        'application/ics' => 'fa-file-calendar',
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
