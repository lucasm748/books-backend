<?php

namespace Tests\Unit\Application\UseCases\Subject\Delete;

use App\Application\UseCases\Subject\Delete\DeleteSubjectInput;
use App\Application\UseCases\Subject\Delete\DeleteSubjectUseCase;
use App\Domain\Entities\Subject;
use App\Domain\Exceptions\SubjectHasBooksException;
use App\Domain\Exceptions\SubjectNotFoundException;
use App\Domain\Interfaces\Repositories\IBooksRepository;
use App\Domain\Interfaces\Repositories\ISubjectsRepository;
use Tests\TestCase;

class DeleteSubjectUseCaseTest extends TestCase
{

    private DeleteSubjectUseCase $useCase;
    private $subjectsRepositoryMock;
    private $booksRepositoryMock;

    protected function setUp(): void
    {
        parent::setUp();
        $this->subjectsRepositoryMock = $this->createMock(ISubjectsRepository::class);
        $this->booksRepositoryMock = $this->createMock(IBooksRepository::class);
        $this->useCase = new DeleteSubjectUseCase(
            $this->subjectsRepositoryMock,
            $this->booksRepositoryMock
        );
    }

    public function testDeleteSubjectSuccessFully()
    {
        $input = new DeleteSubjectInput('123ABC456');

        $this->subjectsRepositoryMock->method('getById')
            ->willReturn(Subject::create('123ABC456', 'Finances'));

        $this->subjectsRepositoryMock->expects($this->once())
            ->method('delete')
            ->with($input->id);

        $this->booksRepositoryMock->method('getBySubject')
            ->willReturn([]);

        $this->useCase->execute($input);
    }

    public function testDeleteSubjectNotFound()
    {
        $input = new DeleteSubjectInput('123ABC456');

        $this->subjectsRepositoryMock->method('getById')
            ->with($input->id)
            ->willReturn(null);

        $this->expectException(SubjectNotFoundException::class);

        $this->useCase->execute($input);
    }

    public function testDeleteSubjectHasBooks()
    {
        $input = new DeleteSubjectInput('123ABC456');

        $this->subjectsRepositoryMock->method('getById')
            ->willReturn(Subject::create('123ABC456', 'Finances'));

        $this->booksRepositoryMock->method('getBySubject')
            ->willReturn([1, 2, 3]);

        $this->expectException(SubjectHasBooksException::class);

        $this->useCase->execute($input);
    }
}
