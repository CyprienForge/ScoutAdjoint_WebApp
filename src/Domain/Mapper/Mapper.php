<?php

namespace Domain\Mapper;

/**
 * @template T
 * @template V
 */
interface Mapper
{
    /**
     * @param T $item
     */
    public static function toDomain($item);

    /**
     * @param V $item
     */
    public static function toInfra($item);
}
