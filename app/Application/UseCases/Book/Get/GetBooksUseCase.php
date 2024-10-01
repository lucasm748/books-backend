<?php

namespace App\Application\UseCases\Book\Get;

use App\Domain\Interfaces\Repositories\IBooksRepository;

class GetBooksUseCase
{
    private IBooksRepository $repository;

    public function __construct(IBooksRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(): GetBooksOutput
    {
        return new GetBooksOutput($this->repository->getAll());
    }
}