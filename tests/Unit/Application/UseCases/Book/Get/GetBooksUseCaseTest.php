<?php

namespace Tests\Unit\Application\UseCases\Book\Get;

use App\Application\UseCases\Book\Get\GetBooksOutput;
use App\Application\UseCases\Book\Get\GetBooksUseCase;
use App\Domain\Entities\Book;
use App\Domain\Interfaces\Repositories\IBooksRepository;
use Illuminate\Foundation\Testing\TestCase;

class GetBooksUseCaseTest extends TestCase
{
    private GetBooksUseCase $useCase;
    private $repositoryMock;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repositoryMock = $this->createMock(IBooksRepository::class);
        $this->useCase = new GetBooksUseCase($this->repositoryMock);
    }

    public function testGetBooksUseCaseSuccessFully()
    {
        $books = [
            $this->createMock(Book::class),
            $this->createMock(Book::class),
            $this->createMock(Book::class),
        ];

        $this->repositoryMock->method('getAll')->willReturn($books);

        $output = $this->useCase->execute();

        $this->assertInstanceOf(GetBooksOutput::class, $output);

        $this->assertEquals($books, $output->books);
    }
}
