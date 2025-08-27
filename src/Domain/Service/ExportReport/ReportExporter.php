<?php

namespace Domain\Service\ExportReport;

interface ReportExporter
{
    public function export($content);
}
