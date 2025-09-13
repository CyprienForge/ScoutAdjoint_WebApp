<?php

namespace Domain\Repository;

/**
 * @template T
 */
interface WriteRepository
{
    /**
     * @param T $item
     */
    public function save($item) : void;

    public function deleteAll();
}
