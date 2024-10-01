<?php

namespace Tests\Unit\Application\UseCases\Subject\GetByName;

use App\Application\UseCases\Subject\GetByDescription\GetSubjectsByDescriptionOutput;
use App\Application\UseCases\Subject\GetByDescription\GetSubjectsByDescriptionUseCase;
use App\Domain\Entities\Subject;
use App\Domain\Exceptions\SubjectNotFoundException;
use App\Domain\Interfaces\Repositories\ISubjectsRepository;
use Illuminate\Foundation\Testing\TestCase;

class GetSubjectsByDescriptionUseCaseTest extends TestCase
{
    private GetSubjectsByDescriptionUseCase  $useCase;
    private $repositoryMock;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repositoryMock = $this->createMock(ISubjectsRepository::class);
        $this->useCase = new GetSubjectsByDescriptionUseCase($this->repositoryMock);
    }

    public function testGetSubjectsByDescriptionSuccessFully()
    {
        $description = 'Ecommerce';
        $subjects = [];
        $subjects[] = Subject::create('123ABC456', 'Ecommerce');

        $this->repositoryMock->method('getByDescription')
            ->with($description)
            ->willReturn($subjects);

        $output = $this->useCase->execute($description);

        $this->assertInstanceOf(GetSubjectsByDescriptionOutput::class, $output);

        $this->assertEquals($subjects, $output->subjects);
    }

    public function testGetSubjectsByDescriptionUseCaseSubjectNotFound()
    {
        $description = 'Ecommerce';
        $subjects = [];

        $this->repositoryMock->method('getByDescription')
            ->with($description)
            ->willReturn([]);

        $this->expectException(SubjectNotFoundException::class);

        $this->useCase->execute($description);
    }
}