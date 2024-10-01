<?php

namespace App\Application\UseCases\Subject\GetByDescription;

use App\Domain\Exceptions\SubjectNotFoundException;
use App\Domain\Interfaces\Repositories\ISubjectsRepository;

class GetSubjectsByDescriptionUseCase
{
    private ISubjectsRepository $repository;

    public function __construct(ISubjectsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(string $description): GetSubjectsByDescriptionOutput
    {
        $subjects = $this->repository->getByDescription($description);

        if (empty($subjects)) {
            throw new SubjectNotFoundException();
        }

        return new GetSubjectsByDescriptionOutput($subjects);
    }
}