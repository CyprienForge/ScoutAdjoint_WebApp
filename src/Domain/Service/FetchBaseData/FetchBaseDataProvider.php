<?php

namespace Domain\Service\FetchBaseData;

interface FetchBaseDataProvider
{
    public function fetchChampionships(): array;
    public function fetchTeams(): array;
}
