<?php

namespace Tests\Unit\Application\UseCases\Book\GetByTitle;

use App\Application\UseCases\Book\GetByTitle\GetBooksByTitleOutput;
use App\Application\UseCases\Book\GetByTitle\GetBooksByTitleUseCase;
use App\Domain\Entities\Book;
use App\Domain\Exceptions\BookNotFoundException;
use App\Domain\Interfaces\Repositories\IBooksRepository;
use Illuminate\Foundation\Testing\TestCase;

class GetBooksByTitleUseCaseTest extends TestCase
{
    private GetBooksByTitleUseCase $useCase;
    private $repositoryMock;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repositoryMock = $this->createMock(IBooksRepository::class);
        $this->useCase = new GetBooksByTitleUseCase($this->repositoryMock);
    }

    public function testGetBooksByTitleSuccessFully()
    {
        $title = 'Cool Book';
        $books = [];
        $books[] = $this->createMock(Book::class);

        $this->repositoryMock->method('getByTitle')
            ->with($title)
            ->willReturn($books);

        $output = $this->useCase->execute($title);

        $this->assertInstanceOf(GetBooksByTitleOutput::class, $output);

        $this->assertEquals($books, $output->books);
    }

    public function testGetBooksByTitleUseCaseBookNotFound()
    {
        $title = 'Cool Book';
        $books = [];

        $this->repositoryMock->method('getByTitle')
            ->with($title)
            ->willReturn([]);

        $this->expectException(BookNotFoundException::class);

        $this->useCase->execute($title);
    }
}
