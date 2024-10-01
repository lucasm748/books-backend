<?php

namespace Tests\Unit\Application\UseCases\Subject\Delete;

use App\Application\UseCases\Subject\Delete\DeleteSubjectInput;
use App\Application\UseCases\Subject\Delete\DeleteSubjectUseCase;
use App\Domain\Entities\Subject;
use App\Domain\Exceptions\SubjectNotFoundException;
use App\Domain\Interfaces\Repositories\ISubjectsRepository;
use Tests\TestCase;

class DeleteSubjectUseCaseTest extends TestCase
{

    private DeleteSubjectUseCase $useCase;
    private $repositoryMock;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repositoryMock = $this->createMock(ISubjectsRepository::class);
        $this->useCase = new DeleteSubjectUseCase($this->repositoryMock);
    }

    public function testDeleteSubjectSuccessFully()
    {
        $input = new DeleteSubjectInput('123ABC456');

        $this->repositoryMock->method('getById')
            ->willReturn(Subject::create('123ABC456', 'Finances'));

        $this->repositoryMock->expects($this->once())
            ->method('delete')
            ->with($input->id);

        $this->useCase->execute($input);
    }

    public function testDeleteSubjectNotFound()
    {
        $input = new DeleteSubjectInput('123ABC456');

        $this->repositoryMock->method('getById')
            ->with($input->id)
            ->willReturn(null);

        $this->expectException(SubjectNotFoundException::class);

        $this->useCase->execute($input);
    }
}