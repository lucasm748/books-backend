<?php

namespace App\Infrastructure\Http\Controllers\Book\Update;

use App\Application\UseCases\Book\Update\UpdateBookInput;
use App\Application\UseCases\Book\Update\UpdateBookUseCase;

class UpdateBookController
{
    private UpdateBookUseCase $useCase;

    public function __construct(UpdateBookUseCase $useCase)
    {
        $this->useCase = $useCase;
    }

    public function update(UpdateBookRequest $request, $id)
    {
        $input = new UpdateBookInput(
            $id,
            $request->title,
            $request->publisher,
            $request->edition,
            $request->publicationYear,
            $request->price,
            $request->authors,
            $request->subjects
        );

        $this->useCase->execute($input);

        return response()->json(['message' => 'Autor atualizado'], 204);
    }
}