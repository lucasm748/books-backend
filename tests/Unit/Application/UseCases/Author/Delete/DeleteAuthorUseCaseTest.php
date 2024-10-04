<?php

namespace Tests\Unit\Application\UseCases\Author\Delete;

use App\Application\UseCases\Author\Delete\DeleteAuthorInput;
use App\Application\UseCases\Author\Delete\DeleteAuthorUseCase;
use App\Domain\Entities\Author;
use App\Domain\Exceptions\AuthorHasBooksException;
use App\Domain\Exceptions\AuthorNotFoundException;
use App\Domain\Interfaces\Repositories\IAuthorsRepository;
use App\Domain\Interfaces\Repositories\IBooksRepository;
use Tests\TestCase;

class DeleteAuthorUseCaseTest extends TestCase
{
    private DeleteAuthorUseCase $useCase;
    private $authorsRepositoryMock;
    private $booksRepositoryMock;


    protected function setUp(): void
    {
        parent::setUp();
        $this->authorsRepositoryMock = $this->createMock(IAuthorsRepository::class);
        $this->booksRepositoryMock = $this->createMock(IBooksRepository::class);
        $this->useCase = new DeleteAuthorUseCase($this->authorsRepositoryMock, $this->booksRepositoryMock);
    }

    public function testDeleteAuthorSuccessFully()
    {
        $input = new DeleteAuthorInput('123ABC456');

        $this->authorsRepositoryMock->method('getById')
            ->willReturn(Author::create('123ABC456', 'John Doe'));

        $this->authorsRepositoryMock->expects($this->once())
            ->method('delete')
            ->with($input->id);

        $this->booksRepositoryMock->method('getByAuthor')
            ->willReturn([]);

        $this->useCase->execute($input);
    }

    public function testDeleteAuthorNotFound()
    {
        $input = new DeleteAuthorInput('123ABC456');

        $this->authorsRepositoryMock->method('getById')
            ->with($input->id)
            ->willReturn(null);

        $this->expectException(AuthorNotFoundException::class);

        $this->useCase->execute($input);
    }

    public function testDeleteAuthorHasBooks()
    {
        $input = new DeleteAuthorInput('123ABC456');

        $this->authorsRepositoryMock->method('getById')
            ->willReturn(Author::create('123ABC456', 'John Doe'));

        $this->booksRepositoryMock->method('getByAuthor')
            ->willReturn([1, 2, 3]);

        $this->expectException(AuthorHasBooksException::class);

        $this->useCase->execute($input);
    }
}
