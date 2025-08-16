<?php

namespace Domain\Validator\EditPlayer;

use Domain\Exception\EditPlayer\BadMimeTypeImageException;
use Domain\Exception\EditPlayer\BadSizeImageException;

class ImageValidator
{
    private static array $mimeTypesValid = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    public static function validSize(int $size)
    {
        if($size > 1000000) throw new BadSizeImageException("L'image est trop lourde");
    }

    public static function validMimeType(string $mimeType)
    {
        if(!in_array($mimeType, self::$mimeTypesValid)) throw new BadMimeTypeImageException("Le mimeType transmit n'est pas pris en charge");
    }

}
