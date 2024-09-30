<?php

namespace App\Application\UseCases\Author\Update;

use App\Domain\Exceptions\AuthorNotFoundException;
use App\Domain\Interfaces\Repositories\IAuthorsRepository;

class UpdateAuthorUseCase
{
    private IAuthorsRepository $repository;

    public function __construct(IAuthorsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(UpdateAuthorInput $input)
    {
        $author = $this->repository->getById($input->id);

        if (!$author) {
            throw new AuthorNotFoundException();
        }

        $author->setName($input->name ?? $author->getName());
        $this->repository->update($author);
    }
}