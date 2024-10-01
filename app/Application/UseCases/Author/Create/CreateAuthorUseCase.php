<?php

namespace App\Application\UseCases\Author\Create;

use App\Domain\Factories\AuthorFactory;
use App\Domain\Interfaces\Repositories\IAuthorsRepository;

class CreateAuthorUseCase
{
    private IAuthorsRepository $repository;
    private AuthorFactory $factory;

    public function __construct(IAuthorsRepository $repository, AuthorFactory $factory)
    {
        $this->repository = $repository;
        $this->factory = $factory;
    }

    public function execute(CreateAuthorInput $input): void
    {
        $author = $this->factory->create($input->name);
        $this->repository->create($author);
    }
}