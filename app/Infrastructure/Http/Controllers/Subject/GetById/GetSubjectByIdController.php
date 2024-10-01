<?php

namespace App\Infrastructure\Http\Controllers\Subject\GetById;

use App\Application\UseCases\Subject\GetById\GetSubjectByIdUseCase;

class GetSubjectByIdController
{
    private GetSubjectByIdUseCase $useCase;

    public function __construct(GetSubjectByIdUseCase $useCase)
    {
        $this->useCase = $useCase;
    }

    public function getById(string $id)
    {
        $output = $this->useCase->execute($id);
        $response = new GetSubjectByIdResponse($output->subject);

        return response()->json($response);
    }
}