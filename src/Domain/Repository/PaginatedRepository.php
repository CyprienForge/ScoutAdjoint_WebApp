<?php

namespace Domain\Repository;

interface PaginatedRepository
{
    public function findPaginated(int $limit, int $offset, ?string $firstName, ?string $lastName);
}
