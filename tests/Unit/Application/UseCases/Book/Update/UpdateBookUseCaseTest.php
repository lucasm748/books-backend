<?php

namespace Tests\Unit\Application\UseCases\Book\Update;

use App\Application\UseCases\Book\Update\UpdateBookInput;
use App\Application\UseCases\Book\Update\UpdateBookUseCase;
use App\Domain\Entities\Author;
use App\Domain\Entities\Book;
use App\Domain\Entities\Subject;
use App\Domain\Exceptions\AuthorNotFoundException;
use App\Domain\Exceptions\BookNotFoundException;
use App\Domain\Exceptions\SubjectNotFoundException;
use App\Domain\Interfaces\Repositories\IAuthorsRepository;
use App\Domain\Interfaces\Repositories\IBooksRepository;
use App\Domain\Interfaces\Repositories\ISubjectsRepository;
use App\Domain\Payloads\CreateBookPayload;
use Illuminate\Foundation\Testing\TestCase;
use Symfony\Component\Uid\Ulid;

class UpdateBookUseCaseTest extends TestCase
{
    private UpdateBookUseCase $useCase;
    private $booksRepositoryMock;
    private $authorsRepositoryMock;
    private $subjectsRepositoryMock;
    private $mockedBook;


    protected function setUp(): void
    {
        $this->booksRepositoryMock = $this->createMock(IBooksRepository::class);
        $this->authorsRepositoryMock = $this->createMock(IAuthorsRepository::class);
        $this->subjectsRepositoryMock = $this->createMock(ISubjectsRepository::class);

        $this->useCase = new UpdateBookUseCase(
            $this->booksRepositoryMock,
            $this->authorsRepositoryMock,
            $this->subjectsRepositoryMock
        );

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

    public function testUpdateBookUseCaseSuccessFully()
    {
        $input = new UpdateBookInput(
            (new Ulid())->toRfc4122(),
            'Book Updated',
            'Publisher Updated',
            2,
            2021,
            100.00,
            ['author1', 'author2'],
            ['subject1', 'subject2']
        );

        $book = $this->createMock(Book::class);
        $authors = [$this->createMock(Author::class), $this->createMock(Author::class)];
        $subjects = [$this->createMock(Subject::class), $this->createMock(Subject::class)];

        $this->booksRepositoryMock->expects($this->once())
            ->method('getById')
            ->with($input->id)
            ->willReturn($book);

        $this->authorsRepositoryMock->expects($this->once())
            ->method('getByIds')
            ->with($input->authors)
            ->willReturn($authors);

        $this->subjectsRepositoryMock->expects($this->once())
            ->method('getByIds')
            ->with($input->subjects)
            ->willReturn($subjects);

        $book->expects($this->once())->method('setAuthors')->with($authors);
        $book->expects($this->once())->method('setSubjects')->with($subjects);
        $book->expects($this->once())->method('setTitle')->with($input->title);
        $book->expects($this->once())->method('setPublisher')->with($input->publisher);
        $book->expects($this->once())->method('setEdition')->with($input->edition);
        $book->expects($this->once())->method('setPublicationYear')->with($input->publicationYear);
        $book->expects($this->once())->method('setPrice')->with($input->price);

        $this->booksRepositoryMock->expects($this->once())
            ->method('update')
            ->with($book);

        $this->useCase->execute($input);
    }

    public function testUpdatebookUseCasebookNotFound()
    {
        $input = new UpdateBookInput(
            (new Ulid())->toRfc4122(),
            'Book Updated',
            'Publisher Updated',
            'Edition Updated',
            2021,
            100.00,
            ['author1', 'author2'],
            ['subject1', 'subject2']
        );

        $this->booksRepositoryMock->expects($this->once())
            ->method('getById')
            ->willReturn(null);

        $this->expectException(BookNotFoundException::class);

        $this->useCase->execute($input);
    }

    public function testUpdatebookUseCaseAuthorsNotFound()
    {
        $input = new UpdateBookInput(
            (new Ulid())->toRfc4122(),
            'Book Updated',
            'Publisher Updated',
            'Edition Updated',
            2021,
            100.00,
            ['author1', 'author2'],
            ['subject1', 'subject2']
        );

        $this->booksRepositoryMock->expects($this->once())
            ->method('getById')
            ->willReturn($this->mockedBook);

        $this->authorsRepositoryMock->expects($this->once())
            ->method('getByIds')
            ->with($input->authors)
            ->willReturn([]);

        $this->expectException(AuthorNotFoundException::class);

        $this->useCase->execute($input);
    }

    public function testUpdatebookUseCaseSubjectsNotFound()
    {
        $this->mockedBook = $this->createMock(Book::class);

        $input = new UpdateBookInput(
            (new Ulid())->toRfc4122(),
            'Book Updated',
            'Publisher Updated',
            'Edition Updated',
            2021,
            100.00,
            ['author1', 'author2'],
            ['subject1', 'subject2']
        );

        $this->booksRepositoryMock->expects($this->once())
            ->method('getById')
            ->willReturn($this->mockedBook);

        $this->authorsRepositoryMock->expects($this->once())
            ->method('getByIds')
            ->with($input->authors)
            ->willReturn($input->authors);

        $this->subjectsRepositoryMock->expects($this->once())
            ->method('getByIds')
            ->with($input->subjects)
            ->willReturn([]);

        $this->expectException(SubjectNotFoundException::class);

        $this->useCase->execute($input);
    }

    public function testUpdateBookUsecaseSomeAuthorNotFound()
    {
        $input = new UpdateBookInput(
            (new Ulid())->toRfc4122(),
            'Book Updated',
            'Publisher Updated',
            'Edition Updated',
            2021,
            100.00,
            ['author1', 'author2'],
            ['subject1', 'subject2']
        );

        $this->booksRepositoryMock->expects($this->once())
            ->method('getById')
            ->willReturn($this->mockedBook);

        $author1 = $this->createMock(Author::class);

        $this->authorsRepositoryMock->expects($this->once())
            ->method('getByIds')
            ->with($input->authors)
            ->willReturn([$author1]);

        $this->expectException(AuthorNotFoundException::class);
        $this->useCase->execute($input);
    }

    public function testUpdateBookUsecaseSomeSubjectNotFound()
    {
        $input = new UpdateBookInput(
            (new Ulid())->toRfc4122(),
            'Book Updated',
            'Publisher Updated',
            'Edition Updated',
            2021,
            100.00,
            ['author1', 'author2'],
            ['subject1', 'subject2']
        );

        $this->booksRepositoryMock->expects($this->once())
            ->method('getById')
            ->with($input->id)
            ->willReturn($this->mockedBook);

        $authors = [$this->createMock(Author::class), $this->createMock(Author::class)];

        $this->authorsRepositoryMock->expects($this->once())
            ->method('getByIds')
            ->with($input->authors)
            ->willReturn($authors);

        $subject1 = $this->createMock(Subject::class);

        $this->subjectsRepositoryMock->expects($this->once())
            ->method('getByIds')
            ->with($input->subjects)
            ->willReturn([$subject1]);

        $this->expectException(SubjectNotFoundException::class);

        $this->useCase->execute($input);
    }
}
