<?php

namespace Tests\Unit\Application\UseCases\Subject\GetById;

use App\Application\UseCases\Subject\GetById\GetSubjectByIdOutput;
use App\Application\UseCases\Subject\GetById\GetSubjectByIdUseCase;
use App\Domain\Entities\Subject;
use App\Domain\Interfaces\Repositories\ISubjectsRepository;
use Illuminate\Foundation\Testing\TestCase;

class GetSubjectByIdUseCaseTest extends TestCase
{
    private GetSubjectByIdUseCase $useCase;
    private $repositoryMock;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repositoryMock = $this->createMock(ISubjectsRepository::class);
        $this->useCase = new GetSubjectByIdUseCase($this->repositoryMock);
    }

    public function testGetSubjectByIdSuccessFully()
    {
        $id = '123ABC456';
        $subject = Subject::create('123ABC456', 'Subject Testable');

        $this->repositoryMock->method('getById')
            ->with($id)
            ->willReturn($subject);

        $output = $this->useCase->execute($id);

        $this->assertInstanceOf(GetSubjectByIdOutput::class, $output);

        $this->assertEquals($subject, $output->subject);
    }
}