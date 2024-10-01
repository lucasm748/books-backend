<?php

namespace App\Application\UseCases\Book\GetById;

use App\Domain\Exceptions\BookNotFoundException;
use App\Domain\Interfaces\Repositories\IBooksRepository;

class GetBookByIdUseCase
{
    private IBooksRepository $repository;

    public function __construct(IBooksRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(string $id): GetBookByIdOutput
    {
        $book = $this->repository->getById($id);

        if (!$book) {
            throw new BookNotFoundException();
        }

        return new GetBookByIdOutput($book);
    }
}