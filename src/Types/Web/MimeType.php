<?php

namespace Mkioschi\Types\Web;

use Mkioschi\Types\InvalidTypeException;

readonly class MimeType
{
    private const array MIMETYPES = [
        'audio/3gpp2',
        'video/3gpp2',
        'audio/3gpp',
        'video/3gpp',
        'application/x-7z-compressed',
        'video/x-msvideo',
        'text/csv',
        'application/msword',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        'image/gif',
        'image/vnd.microsoft.icon',
        'image/jpeg',
        'image/jpeg',
        'application/json',
        'audio/mpeg',
        'video/mp4',
        'video/mpeg',
        'application/vnd.oasis.opendocument.presentation',
        'application/vnd.oasis.opendocument.spreadsheet',
        'application/vnd.oasis.opendocument.text',
        'audio/ogg',
        'video/ogg',
        'audio/ogg',
        'application/pdf',
        'image/png',
        'application/vnd.ms-powerpoint',
        'application/vnd.openxmlformats-officedocument.presentationml.presentation',
        'application/vnd.rar',
        'application/rtf',
        'image/svg+xml',
        'application/x-tar',
        'image/tiff',
        'image/tiff',
        'text/plain',
        'audio/wav',
        'audio/webm',
        'video/webm',
        'image/webp',
        'application/vnd.ms-excel',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        'application/xml',
        'text/xml',
        'application/x-zip-compressed',
        'application/zip',
    ];

    public string $value;

    /**
     * @throws InvalidTypeException
     */
    private function __construct(string $value)
    {
        if (!in_array($value, self::MIMETYPES, true)) {
            throw new InvalidTypeException("Value '$value' is not a valid MIME type.");
        }

        $this->value = $value;
    }

    /**
     * @throws InvalidTypeException
     */
    public static function from(string $value): MimeType
    {
        return new MimeType($value);
    }

    /**
     * @throws InvalidTypeException
     */
    public static function innFrom(?string $value): ?MimeType
    {
        if (is_null($value)) {
            return null;
        }

        return new MimeType($value);
    }
}