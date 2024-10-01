<?php

namespace App\Application\UseCases\Author\GetById;

use App\Domain\Exceptions\AuthorNotFoundException;
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
        $author = $this->repository->getById($id);

        if (!$author) {
            throw new AuthorNotFoundException();
        }

        return new GetAuthorByIdOutput($author);
    }
}