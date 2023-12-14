<?php declare(strict_types=1);

namespace Mkioschi\Types\Web;

use Mkioschi\Exceptions\Http\InvalidTypeHttpException;
use Mkioschi\Types\Str;
use Ramsey\Uuid\Uuid as ThirdPartyUuid;

final class Uuid extends Str
{
    /**
     * @throws InvalidTypeHttpException
     */
    protected function __construct(string $value)
    {
        if (!self::isValid($value)) {
            throw new InvalidTypeHttpException(sprintf('%s is an invalid Uuid type.', $value));
        }

        parent::__construct(strtolower($value));
    }

    public static function isValid(mixed $value): bool
    {
        if (!is_string($value)) {
            return false;
        }

        return ThirdPartyUuid::isValid($value);
    }

    /**
     * Returns an instance of Uuid type with version 4 by default.
     */
    public static function generate(): Uuid
    {
        return Uuid::generateV4();
    }

    public static function generateV4(): Uuid
    {
        return Uuid::from(ThirdPartyUuid::uuid4()->toString());
    }

//    public static function generateV1(): Uuid
//    {
////        TODO implements method.
//    }

//    public static function generateV2(): Uuid
//    {
////        TODO implements method.
//    }

//    public static function generateV3(): Uuid
//    {
////        TODO implements method.
//    }

//    public static function generateV5(): Uuid
//    {
////        TODO implements method.
//    }

//    public static function generateV6(): Uuid
//    {
////        TODO implements method.
//    }
}
