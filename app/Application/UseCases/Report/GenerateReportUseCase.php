<?php

namespace App\Application\UseCases\Report;

use App\Application\Services\GenerateReportApplicationService;

class GenerateReportUseCase
{
    private GenerateReportApplicationService $applicationService;

    public function __construct(GenerateReportApplicationService $applicationService)
    {
        $this->applicationService = $applicationService;
    }

    public function execute()
    {
        return $this->applicationService->generate();
    }
}