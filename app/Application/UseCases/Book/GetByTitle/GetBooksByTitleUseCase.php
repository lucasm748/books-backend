<?php

namespace App\Application\UseCases\Book\GetByTitle;

use App\Domain\Exceptions\BookNotFoundException;
use App\Domain\Interfaces\Repositories\IBooksRepository;

class GetBooksByTitleUseCase
{
    private IBooksRepository $repository;

    public function __construct(IBooksRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(string $title): GetBooksByTitleOutput
    {
        $books = $this->repository->getByTitle($title);

        if (empty($books)) {
            throw new BookNotFoundException();
        }

        return new GetBooksByTitleOutput($books);
    }
}