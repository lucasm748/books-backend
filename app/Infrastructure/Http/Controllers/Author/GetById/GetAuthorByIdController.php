<?php

namespace App\Infrastructure\Http\Controllers\Author\GetById;

use App\Application\UseCases\Author\GetById\GetAuthorByIdUseCase;

class GetAuthorByIdController
{
    private GetAuthorByIdUseCase $useCase;

    public function __construct(GetAuthorByIdUseCase $useCase)
    {
        $this->useCase = $useCase;
    }

    public function getById(string $id)
    {
        $output = $this->useCase->execute($id);
        $response = new GetAuthorByIdResponse($output->author);

        return response()->json($response);
    }
}
