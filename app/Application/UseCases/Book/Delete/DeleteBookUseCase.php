<?php

namespace App\Application\UseCases\Book\Delete;

use App\Domain\Exceptions\BookDeleteException;
use App\Domain\Exceptions\BookNotFoundException;
use App\Domain\Interfaces\Repositories\IBooksRepository;
use Illuminate\Support\Facades\Log;

class DeleteBookUseCase
{
    private IBooksRepository $repository;

    public function __construct(IBooksRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(DeleteBookInput $input)
    {
        $book = $this->repository->getById($input->id);

        if (!$book) {
            throw new BookNotFoundException();
        }

        try {
            $this->repository->delete($input->id);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            throw new BookDeleteException();
        }
    }
}