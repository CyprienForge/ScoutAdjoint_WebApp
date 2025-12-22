<?php

namespace Domain\Response\ExportReport;

class ExportReportResponse
{
    public function __construct(
        public string $pdfBinary,
        public string $fileName
    ){}
}
