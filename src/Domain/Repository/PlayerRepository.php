<?php

namespace Domain\Repository;

use Domain\Entity\Player;

/**
 * @extends Repository<Player>
 */
interface PlayerRepository extends Repository, PaginatedRepository
{
}
