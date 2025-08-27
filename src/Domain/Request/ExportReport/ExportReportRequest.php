<?php

namespace Domain\Request\ExportReport;

class ExportReportRequest
{
    public function __construct(
        public int $idMatch
    ){}

}
