<?php

namespace App\Infrastructure\Http\Controllers\Subject\Update;

use App\Application\UseCases\Subject\Update\UpdateSubjectInput;
use App\Application\UseCases\Subject\Update\UpdateSubjectUseCase;

class UpdateSubjectController
{
    private UpdateSubjectUseCase $useCase;

    public function __construct(UpdateSubjectUseCase $useCase)
    {
        $this->useCase = $useCase;
    }

    public function update(UpdateSubjectRequest $request, $id)
    {
        $input = new UpdateSubjectInput(
            $id,
            $request->description
        );

        $this->useCase->execute($input);

        return response()->json(['message' => 'Assunto atualizado'], 204);
    }
}