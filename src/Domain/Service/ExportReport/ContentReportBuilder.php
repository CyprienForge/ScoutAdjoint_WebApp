<?php

namespace Domain\Service\ExportReport;

use Domain\Dto\ExportReport\ReportDataDTO;

interface ContentReportBuilder
{
    public function buildContent(ReportDataDTO $matchData);
}
