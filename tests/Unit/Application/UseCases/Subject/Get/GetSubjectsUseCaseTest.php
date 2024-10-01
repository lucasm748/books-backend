<?php

namespace Tests\Unit\Application\UseCases\Subject\Get;

use App\Application\UseCases\Subject\Get\GetSubjectsOutput;
use App\Application\UseCases\Subject\Get\GetSubjectsUseCase;
use App\Domain\Entities\Subject;
use App\Domain\Interfaces\Repositories\ISubjectsRepository;
use Illuminate\Foundation\Testing\TestCase;

class GetSubjectsUseCaseTest extends TestCase
{
    private GetSubjectsUseCase $useCase;
    private $repositoryMock;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repositoryMock = $this->createMock(ISubjectsRepository::class);
        $this->useCase = new GetSubjectsUseCase($this->repositoryMock);
    }

    public function testGetSubjectsUseCaseSuccessFully()
    {
        $subjects = [
            Subject::create('123ABC', 'Ecommerce'),
            Subject::create('321DEF', 'Finances'),
        ];

        $this->repositoryMock->method('getAll')->willReturn($subjects);

        $output = $this->useCase->execute();

        $this->assertInstanceOf(GetSubjectsOutput::class, $output);

        $this->assertEquals($subjects, $output->subjects);
    }
}