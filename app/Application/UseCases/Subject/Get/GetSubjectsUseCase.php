<?php

namespace App\Application\UseCases\Subject\Get;

use App\Domain\Interfaces\Repositories\ISubjectsRepository;

class GetSubjectsUseCase
{
    private ISubjectsRepository $repository;

    public function __construct(ISubjectsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(): GetSubjectsOutput
    {
        return new GetSubjectsOutput($this->repository->getAll());
    }
}