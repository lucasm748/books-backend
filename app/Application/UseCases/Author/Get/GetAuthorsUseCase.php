<?php

namespace App\Application\UseCases\Author\Get;

use App\Domain\Interfaces\Repositories\IAuthorsRepository;

class GetAuthorsUseCase
{
    private IAuthorsRepository $repository;

    public function __construct(IAuthorsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(): GetAuthorsOutput
    {
        return new GetAuthorsOutput($this->repository->getAll());
    }
}