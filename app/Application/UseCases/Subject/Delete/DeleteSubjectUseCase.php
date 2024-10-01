<?php

namespace App\Application\UseCases\Subject\Delete;

use App\Domain\Exceptions\SubjectNotFoundException;
use App\Domain\Interfaces\Repositories\ISubjectsRepository;

class DeleteSubjectUseCase
{
    private ISubjectsRepository $repository;

    public function __construct(ISubjectsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(DeleteSubjectInput $input)
    {
        $subject = $this->repository->getById($input->id);

        if (!$subject) {
            throw new SubjectNotFoundException();
        }

        $this->repository->delete($input->id);
    }
}