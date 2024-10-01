<?php

namespace App\Application\UseCases\Subject\GetById;

use App\Domain\Exceptions\SubjectNotFoundException;
use App\Domain\Interfaces\Repositories\ISubjectsRepository;

class GetSubjectByIdUseCase
{
    private ISubjectsRepository $repository;

    public function __construct(ISubjectsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(string $id): GetSubjectByIdOutput
    {
        $subject = $this->repository->getById($id);

        if (!$subject) {
            throw new SubjectNotFoundException();
        }

        return new GetSubjectByIdOutput($subject);
    }
}