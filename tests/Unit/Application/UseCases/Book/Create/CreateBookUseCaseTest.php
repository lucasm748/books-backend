<?php

namespace Tests\Unit\Application\UseCases\Book\Create;

use App\Application\UseCases\Book\Create\CreateBookInput;
use App\Application\UseCases\Book\Create\CreateBookUseCase;
use App\Domain\Entities\Author;
use App\Domain\Entities\Book;
use App\Domain\Entities\Subject;
use App\Domain\Exceptions\AuthorNotFoundException;
use App\Domain\Exceptions\SubjectNotFoundException;
use App\Domain\Factories\BookFactory;
use App\Domain\Interfaces\Repositories\IAuthorsRepository;
use App\Domain\Interfaces\Repositories\IBooksRepository;
use App\Domain\Interfaces\Repositories\ISubjectsRepository;
use App\Domain\Services\UlidGeneratorDomainService;
use Illuminate\Foundation\Testing\TestCase;

class CreateBookUseCaseTest extends TestCase
{
    private CreateBookUseCase $useCase;
    private $booksRepositoryMock;
    private $authorsRepositoryMock;
    private $subjectsRepositoryMock;
    private $bookFactory;

    protected function setUp(): void
    {
        parent::setUp();
        $this->booksRepositoryMock = $this->createMock(IBooksRepository::class);
        $this->authorsRepositoryMock = $this->createMock(IAuthorsRepository::class);
        $this->subjectsRepositoryMock = $this->createMock(ISubjectsRepository::class);
        $ulidGeneratorMock = $this->createMock(UlidGeneratorDomainService::class);
        $ulidGeneratorMock->method('generate')->willReturn('01E8Z6YV1KZ2JQZJYVQVXZQZQZ');

        $this->bookFactory = new BookFactory($ulidGeneratorMock);
        $this->useCase = new CreateBookUseCase(
            $this->booksRepositoryMock,
            $this->authorsRepositoryMock,
            $this->subjectsRepositoryMock,
            $this->bookFactory,
        );
    }

    public function testCreateBookSucessFully()
    {
        $input = new CreateBookInput(
            'Book Name',
            'Publisher',
            1,
            2021,
            100.00,
            ['01E8Z6YV1KZ2JQZJYVQVXZQZQZ'],
            ['01E8Z6YV1KZ2JQZJYVQVXZQZQZ']
        );

        $this->authorsRepositoryMock->method('getByIds')->willReturn([
            $this->createMock(Author::class)
        ]);

        $this->subjectsRepositoryMock->method('getByIds')->willReturn([
            $this->createMock(Subject::class)
        ]);

        $this->booksRepositoryMock->expects($this->once())->method('create');

        $this->useCase->execute($input);
    }

    public function testCreateBookFailWhenAuthorIsNotFound()
    {
        $input = new CreateBookInput(
            'Book Name',
            'Publisher',
            1,
            2021,
            100.00,
            ['01E8Z6YV1KZ2JQZJYVQVXZQZQZ'],
            ['01E8Z6YV1KZ2JQZJYVQVXZQZQZ']
        );

        $this->authorsRepositoryMock->method('getByIds')->willReturn([]);

        $this->expectException(AuthorNotFoundException::class);

        $this->useCase->execute($input);
    }

    public function testCreateBookFailWhenSubjectIsNotFound()
    {
        $input = new CreateBookInput(
            'Book Name',
            'Publisher',
            1,
            2021,
            100.00,
            ['01E8Z6YV1KZ2JQZJYVQVXZQZQZ'],
            ['01E8Z6YV1KZ2JQZJYVQVXZQZQZ']
        );

        $this->authorsRepositoryMock->method('getByIds')->willReturn([
            $this->createMock(Author::class)
        ]);

        $this->subjectsRepositoryMock->method('getByIds')->willReturn([]);

        $this->expectException(SubjectNotFoundException::class);

        $this->useCase->execute($input);
    }
}
