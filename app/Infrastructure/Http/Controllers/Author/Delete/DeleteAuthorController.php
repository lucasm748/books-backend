<?php

namespace App\Infrastructure\Http\Controllers\Author\Delete;

use App\Application\UseCases\Author\Delete\DeleteAuthorInput;
use App\Application\UseCases\Author\Delete\DeleteAuthorUseCase;

class DeleteAuthorController
{
    private DeleteAuthorUseCase $useCase;

    public function __construct(DeleteAuthorUseCase $useCase)
    {
        $this->useCase = $useCase;
    }

    public function delete(DeleteAuthorRequest $request)
    {
        $this->useCase->execute(new DeleteAuthorInput($request->id));
        return response()->json(['message' => 'Autor removido'], 204);
    }
}