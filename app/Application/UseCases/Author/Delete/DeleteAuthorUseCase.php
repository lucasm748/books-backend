<?php

namespace App\Application\UseCases\Author\Delete;

use App\Domain\Exceptions\AuthorHasBooksException;
use App\Domain\Exceptions\AuthorNotFoundException;
use App\Domain\Interfaces\Repositories\IAuthorsRepository;
use App\Domain\Interfaces\Repositories\IBooksRepository;

class DeleteAuthorUseCase
{
    private IAuthorsRepository $authorRepository;
    private IBooksRepository $booksRepository;

    public function __construct(
        IAuthorsRepository $authorRepository,
        IBooksRepository $booksRepository
    ) {
        $this->authorRepository = $authorRepository;
        $this->booksRepository = $booksRepository;
    }

    public function execute(DeleteAuthorInput $input)
    {
        $author = $this->authorRepository->getById($input->id);

        if (!$author) {
            throw new AuthorNotFoundException();
        }

        if (count($this->booksRepository->getByAuthor($input->id)) > 0) {
            throw new AuthorHasBooksException();
        }

        $this->authorRepository->delete($input->id);
    }
}