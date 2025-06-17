<?php

namespace Domain\Repository;

/**
 * @template T
 */
interface Repository
{
    /**
     * @param T $item
     */
    public function save($item) : void;

    /**
     * @return T[]
     */
    public function findAll() : array;

    /**
     * return T|null
     */
    public function findById(int $id);
}
