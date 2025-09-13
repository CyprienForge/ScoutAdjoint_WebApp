<?php

namespace Domain\Repository\User;

use Domain\Repository\WriteRepository;

interface UserWriteRepository extends WriteRepository
{
    public function deleteById(int $id);
}
