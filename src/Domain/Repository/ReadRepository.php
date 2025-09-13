<?php

namespace Domain\Repository;

/**
 * @template T
 */
interface ReadRepository
{
    /**
     * @return T[]
     */
    public function findAll() : array;

    /**
     * return T|null
     */
    public function findById(int $id);
}
