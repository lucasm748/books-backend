<?php

namespace App\Application\UseCases\Author\Delete;

use App\Domain\Exceptions\AuthorNotFoundException;
use App\Domain\Interfaces\Repositories\IAuthorsRepository;

class DeleteAuthorUseCase
{
    private IAuthorsRepository $repository;

    public function __construct(IAuthorsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(DeleteAuthorInput $input)
    {
        $author = $this->repository->getById($input->id);

        if (!$author) {
            throw new AuthorNotFoundException();
        }

        $this->repository->delete($input->id);
    }
}