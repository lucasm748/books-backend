<?php

namespace App\Application\UseCases\Subject\Update;

use App\Domain\Exceptions\SubjectNotFoundException;
use App\Domain\Interfaces\Repositories\ISubjectsRepository;

class UpdateSubjectUseCase
{
    private ISubjectsRepository $repository;

    public function __construct(ISubjectsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(UpdateSubjectInput $input)
    {
        $subject = $this->repository->getById($input->id);

        if (!$subject) {
            throw new SubjectNotFoundException();
        }

        $subject->setDescription($input->description ?? $subject->getDescription());

        $this->repository->update($subject);
    }
}