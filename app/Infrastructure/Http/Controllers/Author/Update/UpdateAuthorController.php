<?php

namespace App\Infrastructure\Http\Controllers\Author\Update;

use App\Application\UseCases\Author\Update\UpdateAuthorInput;
use App\Application\UseCases\Author\Update\UpdateAuthorUseCase;

class UpdateAuthorController
{
    private UpdateAuthorUseCase $useCase;

    public function __construct(UpdateAuthorUseCase $useCase)
    {
        $this->useCase = $useCase;
    }

    public function update(UpdateAuthorRequest $request, $id)
    {
        $input = new UpdateAuthorInput(
            $id,
            $request->name
        );

        $this->useCase->execute($input);

        return response()->json(['message' => 'Author updated'], 204);
    }
}