<?php

namespace App\Infrastructure\Http\Controllers\Report;

use App\Application\UseCases\Report\GenerateReportUseCase;

class ReportController
{
    private GenerateReportUseCase $usecase;

    public function __construct(GenerateReportUseCase $usecase)
    {
        $this->usecase = $usecase;
    }

    public function generate()
    {
        return $this->usecase->execute();
    }
}