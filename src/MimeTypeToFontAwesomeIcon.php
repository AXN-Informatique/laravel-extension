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
        'image/jpeg' => 'fa-file-jpg',
        'image/jpg' => 'fa-file-jpg',
        'image/png' => 'fa-file-png',
        'image/gif' => 'fa-file-gif',
        'image/svg+xml' => 'fa-file-svg',
        'image/x-eps' => 'fa-file-eps',
        'image/webp' => 'fa-file-image',
        'image/avif' => 'fa-file-image',
        'image/bmp' => 'fa-file-image',
        'image/tiff' => 'fa-file-image',
        'image/x-icon' => 'fa-file-image',
        'image' => 'fa-file-image',

        // Audio
        'audio/mpeg' => 'fa-file-mp3',
        'audio/mp3' => 'fa-file-mp3',
        'audio/mp4' => 'fa-file-mp4',
        'audio/x-m4a' => 'fa-file-m4a',
        'audio/wav' => 'fa-file-wav',
        'audio/x-wav' => 'fa-file-wav',
        'audio/ogg' => 'fa-file-audio',
        'audio/webm' => 'fa-file-audio',
        'audio/flac' => 'fa-file-audio',
        'audio/aac' => 'fa-file-aac',
        'audio/midi' => 'fa-file-audio',
        'audio/x-midi' => 'fa-file-audio',
        'audio' => 'fa-file-audio',

        // Video
        'video/mp4' => 'fa-file-mp4',
        'video/avi' => 'fa-file-avi',
        'video/x-msvideo' => 'fa-file-avi',
        'video/quicktime' => 'fa-file-mov',
        'video/mpeg' => 'fa-file-video',
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
        'application/msword' => 'fa-file-doc',
        'application/vnd.ms-word' => 'fa-file-doc',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'fa-file-doc',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.template' => 'fa-file-doc',
        'application/vnd.oasis.opendocument.text' => 'fa-file-doc',
        'application/vnd.openxmlformats-officedocument.wordprocessingml' => 'fa-file-doc',
        'application/rtf' => 'fa-file-richtext',

        // Excel/Spreadsheets
        'application/vnd.ms-excel' => 'fa-file-xls',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' => 'fa-file-xls',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.template' => 'fa-file-xls',
        'application/vnd.openxmlformats-officedocument.spreadsheetml' => 'fa-file-xls',
        'application/vnd.oasis.opendocument.spreadsheet' => 'fa-file-spreadsheet',
        'text/csv' => 'fa-file-csv',
        'application/csv' => 'fa-file-csv',
        'text/tab-separated-values' => 'fa-file-csv',

        // PowerPoint/Presentations
        'application/vnd.ms-powerpoint' => 'fa-file-ppt',
        'application/vnd.openxmlformats-officedocument.presentationml.presentation' => 'fa-file-ppt',
        'application/vnd.openxmlformats-officedocument.presentationml.template' => 'fa-file-ppt',
        'application/vnd.openxmlformats-officedocument.presentationml.slideshow' => 'fa-file-ppt',
        'application/vnd.openxmlformats-officedocument.presentationml' => 'fa-file-ppt',
        'application/vnd.oasis.opendocument.presentation' => 'fa-file-presentation',

        // Text files
        'text/plain' => 'fa-file-txt',
        'text/markdown' => 'fa-file-markdown',
        'text/x-markdown' => 'fa-file-markdown',

        // Code files
        'text/html' => 'fa-file-html',
        'text/xml' => 'fa-file-xml',
        'application/xml' => 'fa-file-xml',
        'application/xhtml+xml' => 'fa-file-xhtml',
        'application/json' => 'fa-file-json',
        'application/ld+json' => 'fa-file-json',
        'text/javascript' => 'fa-file-js',
        'application/javascript' => 'fa-file-js',
        'application/x-javascript' => 'fa-file-js',
        'text/css' => 'fa-file-css',
        'application/x-httpd-php' => 'fa-file-php',
        'application/x-sh' => 'fa-file-bash',
        'text/x-python' => 'fa-file-python',
        'text/x-java-source' => 'fa-file-java',
        'text/x-c' => 'fa-file-c',
        'text/x-c++' => 'fa-file-cpp',
        'application/sql' => 'fa-file-sql',
        'text/yaml' => 'fa-file-yaml',
        'application/x-yaml' => 'fa-file-yaml',

        // Archives
        'application/gzip' => 'fa-file-zip',
        'application/x-gzip' => 'fa-file-zip',
        'application/zip' => 'fa-file-zip',
        'application/x-zip' => 'fa-file-zip',
        'application/x-zip-compressed' => 'fa-file-zip',
        'application/x-7z-compressed' => 'fa-file-7z',
        'application/x-rar' => 'fa-file-rar',
        'application/x-rar-compressed' => 'fa-file-rar',
        'application/x-tar' => 'fa-file-tar',
        'application/x-bzip' => 'fa-file-bz',
        'application/x-bzip2' => 'fa-file-bz2',
        'application/vnd.rar' => 'fa-file-rar',

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
        'application/illustrator' => 'fa-file-ai',
        'image/x-eps' => 'fa-file-eps',
        'application/x-photoshop' => 'fa-file-psd',
        'image/vnd.adobe.photoshop' => 'fa-file-psd',
        'application/x-indesign' => 'fa-file-indd',
        'application/x-sketch' => 'fa-file-sketch',
        'application/x-figma' => 'fa-file-figma',

        // Binaries/Executables
        'application/octet-stream' => 'fa-file-binary',
        'application/x-executable' => 'fa-file-exe',
        'application/x-msdownload' => 'fa-file-exe',
        'application/x-msdos-program' => 'fa-file-exe',
        'application/x-debian-package' => 'fa-file-deb',
        'application/vnd.android.package-archive' => 'fa-file-apk',
        'application/x-apple-diskimage' => 'fa-file-dmg',
        'application/x-msi' => 'fa-file-msi',

        // Calendar
        'text/calendar' => 'fa-file-calendar',
        'application/ics' => 'fa-file-ics',

        // Database
        'application/x-sqlite3' => 'fa-database',
        'application/vnd.sqlite3' => 'fa-database',

        // Config files
        'application/x-yaml' => 'fa-file-gear',
        'text/x-ini' => 'fa-file-gear',
        'application/toml' => 'fa-file-gear',
        'text/x-properties' => 'fa-file-gear',

        // Certificates
        'application/x-pkcs7-certificates' => 'fa-file-shield',
        'application/x-pkcs7-certreqresp' => 'fa-file-shield',

        // Lock files
        'application/x-lockfile' => 'fa-file-lock',

        // User/Access files
        'text/x-vcf' => 'fa-file-user',
        'text/vcard' => 'fa-file-user',
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
