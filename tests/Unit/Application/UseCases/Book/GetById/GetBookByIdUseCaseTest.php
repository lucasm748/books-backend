<?php

namespace Tests\Unit\Application\UseCases\Book\GetById;

use App\Application\UseCases\Book\GetById\GetBookByIdOutput;
use App\Application\UseCases\Book\GetById\GetBookByIdUseCase;
use App\Domain\Entities\Book;
use App\Domain\Interfaces\Repositories\IBooksRepository;
use Illuminate\Foundation\Testing\TestCase;

class GetBookByIdUseCaseTest extends TestCase
{
    private GetBookByIdUseCase $useCase;
    private $repositoryMock;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repositoryMock = $this->createMock(IBooksRepository::class);
        $this->useCase = new GetBookByIdUseCase($this->repositoryMock);
    }

    public function testGetBookByIdSuccessFully()
    {
        $id = '123ABC456';
        $book = $this->createMock(Book::class);

        $this->repositoryMock->method('getById')
            ->with($id)
            ->willReturn($book);

        $output = $this->useCase->execute($id);

        $this->assertInstanceOf(GetBookByIdOutput::class, $output);

        $this->assertEquals($book, $output->book);
    }
}
