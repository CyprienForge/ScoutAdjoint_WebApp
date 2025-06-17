<?php

namespace Domain\Factory;

/**
 * @template T
 */
interface Factory
{
    /**
     * return T
     */
    public static function build($attributes);
}
