<?php

namespace App\Application\UseCases\Author\GetByName;

use App\Domain\Exceptions\AuthorNotFoundException;
use App\Domain\Interfaces\Repositories\IAuthorsRepository;

class GetAuthorsByNameUseCase
{
    private IAuthorsRepository $repository;

    public function __construct(IAuthorsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(string $name): GetAuthorsByNameOutput
    {
        $authors = $this->repository->getByName($name);

        if (empty($authors)) {
            throw new AuthorNotFoundException();
        }
        dd($authors);
        return new GetAuthorsByNameOutput($authors);
    }
}
