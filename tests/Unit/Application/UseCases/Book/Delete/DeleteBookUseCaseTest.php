<?php

namespace Tests\Unit\Application\UseCases\Book\Delete;

use App\Application\UseCases\Book\Delete\DeleteBookInput;
use App\Application\UseCases\Book\Delete\DeleteBookUseCase;
use App\Domain\Entities\Book;
use App\Domain\Exceptions\BookNotFoundException;
use App\Domain\Interfaces\Repositories\IBooksRepository;
use App\Domain\Payloads\CreateBookPayload;
use Tests\TestCase;

class DeleteBookUseCaseTest extends TestCase
{
    private DeleteBookUseCase $useCase;
    private $booksRepositoryMock;
    private $mockedBook;

    protected function setUp(): void
    {
        parent::setUp();
        $this->booksRepositoryMock = $this->createMock(IBooksRepository::class);
        $this->useCase = new DeleteBookUseCase($this->booksRepositoryMock, $this->booksRepositoryMock);
        $this->mockedBook = Book::create(
            '123ABC456',
            new CreateBookPayload(
                'Book Name',
                'Publisher',
                1,
                2021,
                100.00,
                ['01E8Z6YV1KZ2JQZJYVQVXZQZQZ'],
                ['01E8Z6YV1KZ2JQZJYVQVXZQZQZ']
            )
        );
    }

    public function testDeleteBookSuccessFully()
    {
        $input = new DeleteBookInput('123ABC456');

        $this->booksRepositoryMock->method('getById')
            ->with($input->id)
            ->willReturn($this->mockedBook);

        $this->booksRepositoryMock->expects($this->once())
            ->method('delete')
            ->with($input->id);

        $this->useCase->execute($input);
    }

    public function testDeleteBookNotFound()
    {
        $input = new DeleteBookInput('123ABC456');

        $this->booksRepositoryMock->method('getById')
            ->with($input->id)
            ->willReturn(null);

        $this->expectException(BookNotFoundException::class);

        $this->useCase->execute($input);
    }
}
