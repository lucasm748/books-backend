<?php

namespace App\Infrastructure\Http\Controllers\Subject\Delete;

use App\Application\UseCases\Subject\Delete\DeleteSubjectInput;
use App\Application\UseCases\Subject\Delete\DeleteSubjectUseCase;

class DeleteSubjectController
{
    private DeleteSubjectUseCase $useCase;

    public function __construct(DeleteSubjectUseCase $useCase)
    {
        $this->useCase = $useCase;
    }

    public function delete(DeleteSubjectRequest $request)
    {
        $this->useCase->execute(new DeleteSubjectInput($request->id));
        return response()->json(['message' => 'Assunto removido'], 204);
    }
}