<?php

namespace App\Application\UseCases\Author\GetById;

use App\Domain\Interfaces\Repositories\IAuthorsRepository;

class GetAuthorByIdUseCase
{
    private IAuthorsRepository $repository;

    public function __construct(IAuthorsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(string $id): GetAuthorByIdOutput
    {
        return new GetAuthorByIdOutput($this->repository->getById($id));
    }
}
