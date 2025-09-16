<?php

namespace Domain\Repository\User;

use Domain\Repository\WriteRepository;

interface UserWriteRepository extends WriteRepository
{
    public function getLastInsertId() : int;
    public function deleteById(int $id);
}
