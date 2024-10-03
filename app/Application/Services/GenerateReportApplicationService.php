<?php

namespace App\Application\Services;

use App\Infrastructure\Eloquent\Models\BooksReportModelView;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class GenerateReportApplicationService
{
    public function generate()
    {
        $dados = BooksReportModelView::query()
            ->select("*")
            ->get()
            ->toArray();

        $report = [];

        if (count($dados) > 0) {
            foreach ($dados as $key => $value) {
                $report[$value['autor_nome']][] = $value;
            }
        }

        $pdf = PDF::loadView(
            'report',
            ['report' => $report]
        );

        return $pdf->download('report.pdf');
    }
}