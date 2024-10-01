<?php

namespace App\Application\UseCases\Book\Update;

use App\Domain\Exceptions\AuthorNotFoundException;
use App\Domain\Exceptions\BookNotFoundException;
use App\Domain\Exceptions\SubjectNotFoundException;
use App\Domain\Interfaces\Repositories\IAuthorsRepository;
use App\Domain\Interfaces\Repositories\IBooksRepository;
use App\Domain\Interfaces\Repositories\ISubjectsRepository;

class UpdateBookUseCase
{
    private IBooksRepository $booksRepository;
    private IAuthorsRepository $authorsRepository;
    private ISubjectsRepository $subjectsRepository;

    public function __construct(
        IBooksRepository $booksRepository,
        IAuthorsRepository $authorsRepository,
        ISubjectsRepository $subjectsRepository
    ) {
        $this->booksRepository = $booksRepository;
        $this->authorsRepository = $authorsRepository;
        $this->subjectsRepository = $subjectsRepository;
    }

    public function execute(UpdateBookInput $input)
    {
        $book = $this->booksRepository->getById($input->id);

        if (!$book) {
            throw new BookNotFoundException();
        }

        $authors = $this->authorsRepository->getByIds($input->authors);

        if (count($authors) !== count($input->authors)) {
            throw new AuthorNotFoundException();
        }

        $book->setAuthors($authors);

        $subjects = $this->subjectsRepository->getByIds($input->subjects);

        if (count($subjects) !== count($input->subjects)) {
            throw new SubjectNotFoundException();
        }

        $book->setSubjects($subjects);
        $book->setTitle($input->title ?? $book->getTitle());
        $book->setPublisher($input->publisher ?? $book->getPublisher());
        $book->setEdition($input->edition ?? $book->getEdition());
        $book->setPublicationYear($input->publicationYear
            ?? $book->getPublicationYear());
        $book->setPrice($input->price ?? $book->getPrice());

        $this->booksRepository->update($book);
    }
}