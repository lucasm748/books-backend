<?php

namespace App\Infrastructure\Http\Controllers\Book\Delete;

use App\Application\UseCases\Book\Delete\DeleteBookInput;
use App\Application\UseCases\Book\Delete\DeleteBookUseCase;

class DeleteBookController
{
    private DeleteBookUseCase $useCase;

    public function __construct(DeleteBookUseCase $useCase)
    {
        $this->useCase = $useCase;
    }

    public function delete(DeleteBookRequest $request)
    {
        $this->useCase->execute(new DeleteBookInput($request->id));
        return response()->json(['message' => 'Livro removido'], 204);
    }
}