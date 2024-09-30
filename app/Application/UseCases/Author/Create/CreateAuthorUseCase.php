<?php

namespace App\Application\UseCases\Author\Create;

use App\Domain\Entities\Author;
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
        $author = new Author($input->name);

        try {
            $this->repository->create($author);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}