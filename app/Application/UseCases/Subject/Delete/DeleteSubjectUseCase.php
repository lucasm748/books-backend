<?php

namespace App\Application\UseCases\Subject\Delete;

use App\Domain\Exceptions\SubjectHasBooksException;
use App\Domain\Exceptions\SubjectNotFoundException;
use App\Domain\Interfaces\Repositories\IBooksRepository;
use App\Domain\Interfaces\Repositories\ISubjectsRepository;

class DeleteSubjectUseCase
{
    private ISubjectsRepository $subjectsRepository;
    private IBooksRepository $booksRepository;

    public function __construct(
        ISubjectsRepository $subjectsRepository,
        IBooksRepository $booksRepository
    ) {
        $this->subjectsRepository = $subjectsRepository;
        $this->booksRepository = $booksRepository;
    }

    public function execute(DeleteSubjectInput $input)
    {
        if (!$this->subjectsRepository->getById($input->id)) {
            throw new SubjectNotFoundException();
        }

        if (count($this->booksRepository->getBySubject($input->id)) > 0) {
            throw new SubjectHasBooksException();
        }

        $this->subjectsRepository->delete($input->id);
    }
}