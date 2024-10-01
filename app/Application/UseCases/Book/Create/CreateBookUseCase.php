<?php

namespace App\Application\UseCases\Book\Create;

use App\Domain\Exceptions\AuthorNotFoundException;
use App\Domain\Exceptions\SubjectNotFoundException;
use App\Domain\Factories\BookFactory;
use App\Domain\Interfaces\Repositories\IAuthorsRepository;
use App\Domain\Interfaces\Repositories\IBooksRepository;
use App\Domain\Interfaces\Repositories\ISubjectsRepository;
use App\Domain\Payloads\CreateBookPayload;

class CreateBookUseCase
{
    private IBooksRepository $booksRepository;
    private IAuthorsRepository $authorsRepository;
    private ISubjectsRepository $subjectsRepository;
    private BookFactory $factory;

    public function __construct(
        IBooksRepository $booksRepository,
        IAuthorsRepository $authorsRepository,
        ISubjectsRepository $subjectsRepository,
        BookFactory $factory
    ) {
        $this->booksRepository = $booksRepository;
        $this->authorsRepository = $authorsRepository;
        $this->subjectsRepository = $subjectsRepository;
        $this->factory = $factory;
    }

    public function execute(CreateBookInput $input): void
    {

        $authors = $this->authorsRepository->getByIds($input->authors);

        if (count($authors) !== count($input->authors)) {
            throw new AuthorNotFoundException();
        }

        $subjects = $this->subjectsRepository->getByIds($input->subjects);

        if (count($subjects) !== count($input->subjects)) {
            throw new SubjectNotFoundException();
        }

        $payload = new CreateBookPayload(
            $input->title,
            $input->publisher,
            $input->edition,
            $input->publicationYear,
            $input->price,
            $authors,
            $subjects
        );

        $this->booksRepository->create($this->factory->create($payload));
    }
}