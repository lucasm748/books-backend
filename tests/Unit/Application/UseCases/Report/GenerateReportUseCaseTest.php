<?php

namespace Tests\Unit\Application\UseCases\Report;

use App\Application\Services\GenerateReportApplicationService;
use App\Application\UseCases\Report\GenerateReportUseCase;
use Illuminate\Foundation\Testing\TestCase;

class GenerateReportUseCaseTest extends TestCase
{
    public function testExecute()
    {
        $generateReportApplicationService = $this->createMock(GenerateReportApplicationService::class);
        $generateReportApplicationService->expects($this->once())
            ->method('generate')
            ->willReturn('report.pdf');

        $generateReportUseCase = new GenerateReportUseCase($generateReportApplicationService);
        $result = $generateReportUseCase->execute();

        $this->assertEquals('report.pdf', $result);
    }
}
