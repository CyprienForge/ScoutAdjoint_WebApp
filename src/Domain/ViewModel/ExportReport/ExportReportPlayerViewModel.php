<?php

namespace Domain\ViewModel\ExportReport;

use Domain\Entity\Participation;

class ExportReportPlayerViewModel
{
    public function __construct(
        public Participation  $participation,
        public array $notes
    ){}

    public function getNumero() : int
    {
        return $this->participation->getNumero();
    }

    public function getName() : string
    {
        return $this->participation->getPlayer()->getFirstName() . ' ' . $this->participation->getPlayer()->getLastName();
    }

    public function getYear() : string
    {
        return $this->participation->getPlayer()->getBirthDate()->format('Y');
    }
}
