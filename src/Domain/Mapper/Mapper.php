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
    public function toDomain($item);

    /**
     * @param V $item
     */
    public function toInfra($item);
}
