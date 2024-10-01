<?php

namespace Tests\Unit\Application\UseCases\Author\Update;

use App\Application\UseCases\Author\Update\UpdateAuthorInput;
use App\Application\UseCases\Author\Update\UpdateAuthorUseCase;
use App\Domain\Entities\Author;
use App\Domain\Exceptions\AuthorNotFoundException;
use App\Domain\Interfaces\Repositories\IAuthorsRepository;
use Illuminate\Foundation\Testing\TestCase;
use Symfony\Component\Uid\Ulid;

class UpdateAuthorUseCaseTest extends TestCase
{
    private UpdateAuthorUseCase $useCase;
    private $repositoryMock;

    protected function setUp(): void
    {
        $this->repositoryMock = $this->createMock(IAuthorsRepository::class);
        $this->useCase = new UpdateAuthorUseCase($this->repositoryMock);
    }

    public function testUpdateAuthorUseCaseSuccessFully()
    {
        $mockExistentAuthor = $this->createMock(Author::class);
        $input = new UpdateAuthorInput((new Ulid())->toRfc4122(), 'Eric Updated');

        $this->repositoryMock->expects($this->once())
            ->method('getById')
            ->willReturn($mockExistentAuthor);

        $mockExistentAuthor->expects($this->once())
            ->method('setName')
            ->with($input->name);

        $this->repositoryMock->expects($this->once())
            ->method('update')
            ->with($mockExistentAuthor);

        $this->useCase->execute($input);

        $this->assertTrue(true);
    }

    public function testUpdateAuthorUseCaseAuthorNotFound()
    {
        $input = new UpdateAuthorInput((new Ulid())->toRfc4122(), 'Eric Updated');

        $this->repositoryMock->expects($this->once())
            ->method('getById')
            ->willReturn(null);

        $this->expectException(AuthorNotFoundException::class);

        $this->useCase->execute($input);
    }
}