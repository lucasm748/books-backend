<?php

namespace Tests\Unit\Application\UseCases\Subject\Update;

use App\Application\UseCases\Subject\Update\UpdateSubjectInput;
use App\Application\UseCases\Subject\Update\UpdateSubjectUseCase;
use App\Domain\Entities\Subject;
use App\Domain\Exceptions\SubjectNotFoundException;
use App\Domain\Interfaces\Repositories\ISubjectsRepository;
use Illuminate\Foundation\Testing\TestCase;
use Symfony\Component\Uid\Ulid;

class UpdateSubjectUseCaseTest extends TestCase
{
    private UpdateSubjectUseCase $useCase;
    private $repositoryMock;

    protected function setUp(): void
    {
        $this->repositoryMock = $this->createMock(ISubjectsRepository::class);
        $this->useCase = new UpdateSubjectUseCase($this->repositoryMock);
    }

    public function testUpdateSubjectUseCaseSuccessFully()
    {
        $mockExistentSubject = $this->createMock(Subject::class);
        $input = new UpdateSubjectInput((new Ulid())->toRfc4122(), 'Eric Updated');

        $this->repositoryMock->expects($this->once())
            ->method('getById')
            ->willReturn($mockExistentSubject);

        $mockExistentSubject->expects($this->once())
            ->method('setDescription')
            ->with($input->description);

        $this->repositoryMock->expects($this->once())
            ->method('update')
            ->with($mockExistentSubject);

        $this->useCase->execute($input);

        $this->assertTrue(true);
    }

    public function testUpdateSubjectUseCaseSubjectNotFound()
    {
        $input = new UpdateSubjectInput((new Ulid())->toRfc4122(), 'Eric Updated');

        $this->repositoryMock->expects($this->once())
            ->method('getById')
            ->willReturn(null);

        $this->expectException(SubjectNotFoundException::class);

        $this->useCase->execute($input);
    }
}