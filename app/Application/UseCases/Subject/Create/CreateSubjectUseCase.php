<?php

namespace App\Application\UseCases\Subject\Create;

use App\Domain\Factories\SubjectFactory;
use App\Domain\Interfaces\Repositories\ISubjectsRepository;

class CreateSubjectUseCase
{
    private ISubjectsRepository $repository;
    private SubjectFactory $factory;

    public function __construct(ISubjectsRepository $repository, SubjectFactory $factory)
    {
        $this->repository = $repository;
        $this->factory = $factory;
    }

    public function execute(CreateSubjectInput $input): void
    {
        $subject = $this->factory->create($input->description);
        $this->repository->create($subject);
    }
}