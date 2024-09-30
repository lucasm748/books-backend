<?php

namespace App\Application\UseCases\Author\Create;

use App\Application\Factories\AuthorFactory;
use App\Domain\Interfaces\Repositories\IAuthorsRepository;

class CreateAuthorUseCase
{
    private IAuthorsRepository $repository;

    public function __construct(IAuthorsRepository $repository)
    {
        $this->repository = $repository;
    }


    public function execute(CreateAuthorInput $input): void
    {
        $author = AuthorFactory::create($input->name);

        try {
            $this->repository->create($author);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}