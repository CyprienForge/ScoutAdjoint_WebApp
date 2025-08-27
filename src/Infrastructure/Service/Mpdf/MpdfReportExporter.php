<?php

namespace Infrastructure\Service\Mpdf;

use Domain\Service\ExportReport\ReportExporter;
use Mpdf\Mpdf;

class MpdfReportExporter implements ReportExporter
{

    public function export($html)
    {
        $mpdf = new Mpdf([
            'format' => 'A4-L',
            'margin_left' => 0,
            'margin_right' => 0,
            'margin_top' => 0,
            'margin_bottom' => 0,
        ]);

        $mpdf->WriteHTML($html);
        $mpdf->Output('filename.pdf', 'D');
    }
}
