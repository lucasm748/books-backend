<?php

namespace Tests\Unit\Application\UseCases\Subject\Create;

use App\Application\UseCases\Subject\Create\CreateSubjectInput;
use App\Application\UseCases\Subject\Create\CreateSubjectUseCase;
use App\Domain\Entities\Subject;
use App\Domain\Factories\SubjectFactory;
use App\Domain\Interfaces\Repositories\ISubjectsRepository;
use App\Domain\Services\UlidGeneratorDomainService;
use Illuminate\Foundation\Testing\TestCase;

class CreateSubjectUseCaseTest extends TestCase
{
    private CreateSubjectUseCase $useCase;
    private $repositoryMock;
    private $subjectFactory;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repositoryMock = $this->createMock(ISubjectsRepository::class);
        $ulidGeneratorMock = $this->createMock(UlidGeneratorDomainService::class);
        $ulidGeneratorMock->method('generate')->willReturn('01E8Z6YV1KZ2JQZJYVQVXZQZQZ');

        $this->subjectFactory = new SubjectFactory($ulidGeneratorMock);
        $this->useCase = new CreateSubjectUseCase($this->repositoryMock, $this->subjectFactory);
    }

    public function testExecuteUseCaseSuccessFully()
    {
        $input = new CreateSubjectInput('Ecommerce');

        $this->repositoryMock->expects($this->once())
            ->method('create')
            ->with($this->callback(function ($subject) use ($input) {
                return $subject instanceof Subject
                    && $subject->getDescription() === $input->description
                    && $subject->getId() === '01E8Z6YV1KZ2JQZJYVQVXZQZQZ';
            }));

        $this->useCase->execute($input);
    }
}